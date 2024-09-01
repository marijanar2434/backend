<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Maintenance\MaintenanceType;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;

class DoctrineMaintenanceTypeRepository extends DoctrineRepository implements MaintenanceTypeRepository
{

    public function findByName(string $name): ?MaintenanceType
    {
        return $this->findOneBy(['name' => $name]);
    }
}
