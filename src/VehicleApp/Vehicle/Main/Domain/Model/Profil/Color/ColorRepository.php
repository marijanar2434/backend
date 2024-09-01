<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color;

use App\Common\Domain\Repository;

interface ColorRepository extends Repository
{

    public function findByName(string $name): ?Color;
    
}