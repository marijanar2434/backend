<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;

interface PartAndServiceRepository extends Repository
{

    public function findByName(string $name): ?PartAndService;
    
}
