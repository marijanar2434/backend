<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Vehicle\Specification\UniqueVehicleSpecification;

class VehicleValidator extends Validator
{
    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueChassisNumber($object)) {
            $notificationHandler->addNotification(
                'Vehicle  with chassis number:[{{ chassis }}] already exists.',
                [
                    '{{ chassis }}' => $object->getChassisNumber()
                ],
                'chassis'
            );
        }
        return $notificationHandler;
    }


    private function hasUniqueChassisNumber(Vehicle $vehicle): bool
    {
        return (new UniqueVehicleSpecification($this->vehicleRepository))->isSatisfiedBy($vehicle);
    }
}
