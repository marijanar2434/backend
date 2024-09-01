<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType;

use App\Common\Domain\Repository;

interface MaintenanceTypeRepository extends Repository
{
    public function findByName(string $name): ?MaintenanceType;
}
