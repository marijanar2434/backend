<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense\ExpenseType;

use App\VehicleApp\Vehicle\Main\Domain\Exception\FuelAndExpense\ExpenseType\ExpenseTypeIsAttachedToFuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;

class ExpenseTypeDestroyer
{
    /**
     * 
     *
     * @var ExpenseTypeRepository
     */
    private  $expenseTypeRepository;


    /**
     * 
     *
     * @var FuelAndExpenseRepository
     */
    private  $fuelAndExpenseRepository;

    /**
     * 
     *
     * @param ExpenseTypeRepository $expenseTypeRepository
     * @param FuelAndExpenseRepository $fuelAndExpenseRepository
     */
    public function __construct(ExpenseTypeRepository $expenseTypeRepository, FuelAndExpenseRepository $fuelAndExpenseRepository)
    {
        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
    }

    /**
     * 
     *
     * @param ExpenseType $expenseType
     * @return void
     */
    public function destroy(ExpenseType $expenseType): void
    {
        $res = $this->fuelAndExpenseRepository->countByExpenseTypeId($expenseType->getId());
        
        if ($res > 0)
            throw new ExpenseTypeIsAttachedToFuelAndExpense();

        $this->expenseTypeRepository->remove($expenseType);
    }
}
