<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance;

use App\Common\Domain\Repository;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface MaintenanceRepository extends Repository
{
    public function findByName(string $name): ?Maintenance;

    public function VehicleMaintenancesGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult;

    public function countByParAndServiceId(Id $partAndServiceId): int;

    public function countByMaintenanceTypeId(Id $maintenanceTypeId): int;
}
