<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType;

use App\Common\Domain\Repository;

interface CollabTypeRepository extends Repository
{
    public function findByName(string $name): ?CollabType;
}

