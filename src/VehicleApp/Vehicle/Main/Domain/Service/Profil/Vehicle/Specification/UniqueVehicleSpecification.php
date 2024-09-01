<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Vehicle\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class UniqueVehicleSpecification extends Specification
{
    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param Vehicle $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $vehicle = $this->vehicleRepository->findByChassis(
            $object->getChassisNumber()
        );

        return $vehicle === null || $object->getId()->equals($vehicle->getId());
    }
}

