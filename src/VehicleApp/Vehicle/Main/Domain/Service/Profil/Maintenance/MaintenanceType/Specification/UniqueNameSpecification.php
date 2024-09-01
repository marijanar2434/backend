<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance\MaintenanceType\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository)
    {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
    }

    /**
     * @param MaintenanceType $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
         $maintenanceType = $this->maintenanceTypeRepository->findByName(
            $object->getName()
        );

        return $maintenanceType === null || $object->getId()->equals($maintenanceType->getId());
    }
}

