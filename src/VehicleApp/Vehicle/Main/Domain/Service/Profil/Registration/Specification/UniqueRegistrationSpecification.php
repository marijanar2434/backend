<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Registration\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use DateTimeImmutable;

class UniqueRegistrationSpecification extends Specification
{
    /**
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param RegistrationRepository $registrationRepository
     */
    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * @param Registration $object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {

        $registrations = $this->registrationRepository->findByRegNumber($object->getRegistrationNumber());
        return empty($registrations) ? true : false;

    }
}
