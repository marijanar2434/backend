<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\CollabType;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;

class DoctrineCollabTypeRepository extends DoctrineRepository implements CollabTypeRepository
{

    public function findByName(string $name): ?CollabType
    {
        return $this->findOneBy(['name' => $name]);
    }
}