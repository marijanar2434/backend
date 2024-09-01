<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType;

use App\Common\Domain\Repository;

interface ExpenseTypeRepository extends Repository
{
    public function findByName(string $name): ?ExpenseType;
}
