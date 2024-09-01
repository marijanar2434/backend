<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;

interface VehicleRepository extends Repository
{

    public function findByName(string $name): ?Vehicle;
    
    public function findByChassis(string $chassis): ?Vehicle;

    public function countByTypeId(Id $typeId): int;

    public function countByColorId(Id $colorId): int;
}

