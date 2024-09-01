<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle;

use App\Common\Domain\Repository;

interface UserVehicleRepository extends Repository
{
    public function findByName(string $name): ?UserVehicle;

}

