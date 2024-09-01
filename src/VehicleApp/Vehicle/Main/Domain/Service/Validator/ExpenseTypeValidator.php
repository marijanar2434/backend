<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense\ExpenseType\Specification\UniqeuNameSpecification;

class ExpenseTypeValidator extends Validator
{
    /**
     * @var ExpenseTypeRepository
     */ 
    private   $expenseTypeRepository;

    /**
     * BrandValidator Constructor
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Expense type with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(ExpenseType $expenseType): bool
    {
        return (new UniqeuNameSpecification($this->expenseTypeRepository))->isSatisfiedBy($expenseType);
    }
}
