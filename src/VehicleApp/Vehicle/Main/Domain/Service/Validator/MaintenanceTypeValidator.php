<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance\MaintenanceType\Specification\UniqueNameSpecification;

class MaintenanceTypeValidator extends Validator
{
    /**
     * @var MaintenanceTypeRepository
     */ 
    private  $maintenanceTypeRepository;

    /**
     * BrandValidator Constructor
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository)
    {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Maintenance type with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(MaintenanceType $maintenanceType): bool
    {
        return (new UniqueNameSpecification($this->maintenanceTypeRepository))->isSatisfiedBy($maintenanceType);
    }
}
