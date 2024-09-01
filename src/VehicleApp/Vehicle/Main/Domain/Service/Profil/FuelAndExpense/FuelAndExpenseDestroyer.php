<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\FuelAndExpense;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;

class FuelAndExpenseDestroyer
{
    /**
     * 
     *
     * @var FuelAndExpenseRepository
     */
    private $fuelAndExpenseRepository;

    /**
     * @param FuelAndExpenseRepository $fuelAndExpenseRepository
     */
    public function __construct(FuelAndExpenseRepository $fuelAndExpenseRepository)
    {
        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
    }

    /**
     * 
     *
     * @param FuelAndExpense $fuelAndExpense
     * @return void
     */
    public function destroy(FuelAndExpense $fuelAndExpense): void
    {
        $this->fuelAndExpenseRepository->remove($fuelAndExpense);
    }
}
