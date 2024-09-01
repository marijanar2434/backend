<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseType\ExpenseTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;

class UpdateExpenseTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var ExpenseTypeRepository
     */
    private  $expenseTypeRepository;


    public function __construct(ExpenseTypeRepository $expenseTypeRepository)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
    }

    public function __invoke(UpdateExpenseTypeCommand $command)
    {

        /**
         * @var ExpenseType|null
         */

        $expenseType = $this->expenseTypeRepository->findById(new Id($command->getId()));


        if (empty($expenseType)) {
            throw new ExpenseTypeNotFoundException();
        }

        $expenseType->updateProperties($command->getName());
        $this->expenseTypeRepository->save($expenseType);
    }
}
