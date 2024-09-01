<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client;

use App\Common\Domain\Repository;

interface ClientRepository extends Repository
{
    public function findByName(string $name): ?Client;

    public function findByEmail(string $email): ?Client;
}

