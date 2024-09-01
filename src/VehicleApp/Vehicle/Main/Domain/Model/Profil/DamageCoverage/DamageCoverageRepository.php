<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage;

use App\Common\Domain\Repository;

interface DamageCoverageRepository extends Repository
{
    public function findByName(string $name): ?DamageCoverage;
}
