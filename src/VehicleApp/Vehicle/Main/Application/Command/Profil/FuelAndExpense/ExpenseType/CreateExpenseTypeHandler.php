<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\ExpenseTypeValidator;

class CreateExpenseTypeHandler implements CommandHandler
{
    /**
     * 
     *
     * @var ExpenseTypeRepository
     */
    private  ExpenseTypeRepository  $expenseTypeRepository;


    /**
     * 
     *
     * @var ExpenseTypeValidator
     */
    private  $expenseTypeValidator;


    public function __construct(
        ExpenseTypeRepository $expenseTypeRepository,
        ExpenseTypeValidator $expenseTypeValidator
    ) {
        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->expenseTypeValidator = $expenseTypeValidator;
    }

    public function __invoke(CreateExpenseTypeCommand $command)
    {
        $expenseType = new ExpenseType(
            new Id($command->getId()),
            $command->getName()
        );

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->expenseTypeValidator->validate($expenseType);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->expenseTypeRepository->save($expenseType);
    }
}
