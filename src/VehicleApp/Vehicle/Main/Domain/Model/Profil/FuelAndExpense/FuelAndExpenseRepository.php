<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense;

use App\Common\Domain\Repository;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface FuelAndExpenseRepository extends Repository
{
    public function findByName(string $name): ?FuelAndExpense;

    /**
     * 
     *
     * @param Id $vehicleId
     * @param Criteria $criteria
     * @return RepositoryQueryResult
     */
    public function VehicleFuelAndExpenseGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult;


    public function countByExpenseTypeId(Id $expenseTypeId): int;
}