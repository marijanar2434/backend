<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Registration\Specification\UniqueRegistrationSpecification;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Registration\Specification\UniqueVehicleRegistrationSpecification;

class RegistrationValidator extends Validator
{
    /**
     * @var RegistrationRepository
     */
    private $registrationRepository;

    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

    
        
        if (!$this->hasUniqueRegistrationNumber($object)) {
           
            $notificationHandler->addNotification(
                'Registration  with registration number:[{{ registration }}] still have valid registration.',
                [
                    '{{ registration }}' => $object->getRegistrationNumber()
                ],
                'registration'
            );
        }

        if (!$this->hasUniqueVehicle($object)) {
            $notificationHandler->addNotification(
                'Vehicle  with id:[{{ id }}] already have active registration.',
                [
                    '{{ id }}' => $object->getVehicle()->getId()
                ],
                'id'
            );
        }
        return $notificationHandler;
    }


    private function hasUniqueRegistrationNumber(Registration $registration): bool
    {
        return (new UniqueRegistrationSpecification($this->registrationRepository))->isSatisfiedBy($registration);
    }

    private function hasUniqueVehicle(Registration $registration): bool
    {
        return (new UniqueVehicleRegistrationSpecification($this->registrationRepository))->isSatisfiedBy($registration);
    }
}
