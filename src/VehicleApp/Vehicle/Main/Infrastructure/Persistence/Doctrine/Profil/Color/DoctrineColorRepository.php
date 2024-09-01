<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Color;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;

class DoctrineColorRepository extends DoctrineRepository implements ColorRepository
{ 
    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?Color
    {
        return $this->findOneBy(['name' => $name]);
    }
}