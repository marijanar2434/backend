<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\UserVehicle;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class DoctrineUserVehicleRepository extends DoctrineRepository implements UserVehicleRepository
{ 

    public function findByName(string $name): ?UserVehicle
    {
        return $this->findOneBy(['fullname' => $name]);
    }
}