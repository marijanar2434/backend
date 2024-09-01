<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Registration;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;

class RegistrationDestroyer
{

    /**
     * 
     *
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * @param RegistrationRepository $registrationRepository
     */
    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * 
     *
     * @param Registration $registration
     * @return void
     */
    public function destroy(Registration $registration): void
    {
        $this->registrationRepository->remove($registration);
    }
}
