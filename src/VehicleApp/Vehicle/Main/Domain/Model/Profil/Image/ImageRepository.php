<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image;

use App\Common\Domain\Repository;

interface ImageRepository extends Repository
{

    public function findByName(string $name): ?Image;
    
}
