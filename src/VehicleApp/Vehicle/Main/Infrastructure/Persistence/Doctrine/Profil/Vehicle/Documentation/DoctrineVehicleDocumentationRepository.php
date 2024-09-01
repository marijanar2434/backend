<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle\Documentation;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Documentation\VehicleDocumentation;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Documentation\VehicleDocumentationRepository;

class DoctrineVehicleDocumentationRepository extends DoctrineRepository implements VehicleDocumentationRepository
{ 

    public function findByName(string $name): ?VehicleDocumentation
    {
        return $this->findOneBy(['name' => $name]);
    }
}
