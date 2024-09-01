<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\FuelAndExpense\ExpenseType;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseTypeRepository;

class DoctrineExpenseTypeRepository extends DoctrineRepository implements ExpenseTypeRepository
{

    public function findByName(string $name): ?ExpenseType
    {
        return $this->findOneBy(['name' => $name]);
    }

}
