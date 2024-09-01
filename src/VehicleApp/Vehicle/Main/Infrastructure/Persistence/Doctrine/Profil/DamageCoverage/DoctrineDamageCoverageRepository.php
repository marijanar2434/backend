<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\DamageCoverage;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;

class DoctrineDamageCoverageRepository extends DoctrineRepository implements DamageCoverageRepository
{

    public function findByName(string $name): ?DamageCoverage
    {
        return $this->findOneBy(['name' => $name]);
    }
}
