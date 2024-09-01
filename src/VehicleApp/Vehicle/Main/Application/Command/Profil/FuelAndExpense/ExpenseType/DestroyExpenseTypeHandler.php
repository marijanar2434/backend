<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseType\ExpenseTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseType\ExpIsAttachedToFuelAndExpenseException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\FuelAndExpense\ExpenseType\ExpenseTypeIsAttachedToFuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense\ExpenseType\ExpenseTypeDestroyer;

class DestroyExpenseTypeHandler  implements CommandHandler
{

    /**
     * 
     *
     * @var ExpenseTypeRepository
     */
    private    $expenseTypeRepository;

    /**
     * 
     *
     * @var ExpenseTypeDestroyer
     */
    private $expenseTypeDestroyer;


    /**
     * 
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     * @param ExpenseTypeDestroyer $expenseTypeDestroyer
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository, ExpenseTypeDestroyer $expenseTypeDestroyer)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->expenseTypeDestroyer = $expenseTypeDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyExpenseTypeCommand $command)
    {
        /**
         * @var ExpenseType|null
         */

        $fuelandExpense = $this->expenseTypeRepository->findById(new Id($command->getId()));

        if (empty($fuelandExpense)) {
            throw new ExpenseTypeNotFoundException();
        }


        try {
            $this->expenseTypeDestroyer->destroy($fuelandExpense);
        } catch (ExpenseTypeIsAttachedToFuelAndExpense) {
            throw new ExpIsAttachedToFuelAndExpenseException();
        }
    }
}
