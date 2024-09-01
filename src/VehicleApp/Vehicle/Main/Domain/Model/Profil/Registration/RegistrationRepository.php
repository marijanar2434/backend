<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration;

use App\Common\Domain\Repository;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;

interface RegistrationRepository extends Repository
{

    public function findByName(string $name): ?Registration;

    public function findByRegNumber(string $regnumber): ?array;

    public function findByVehicleId(Id $id): ?array;

     /**
     * @param Id $vehicleId
     * @param Criteria $criteria
     * 
     * @return RepositoryQueryResult
     */
    public function VehicleRegistrationsGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult;


}
