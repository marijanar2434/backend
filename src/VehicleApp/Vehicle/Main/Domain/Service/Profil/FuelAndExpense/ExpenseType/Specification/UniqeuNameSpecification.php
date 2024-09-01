<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense\ExpenseType\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;

class UniqeuNameSpecification extends Specification
{
    /**
     * @var ExpenseTypeRepository
     */
    private   $expenseTypeRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
    }

    /**
     * @param  ExpenseType$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
             $expenseType = $this->expenseTypeRepository->findByName($object->getName()
        );

        return $expenseType === null || $object->getId()->equals($expenseType->getId());
    }
}


