<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Image;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\Image;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\ImageRepository;

class DoctrineImageRepository extends DoctrineRepository implements ImageRepository
{ 

    public function findByName(string $name): ?Image
    {
        return $this->findOneBy(['name' => $name]);
    }
}
