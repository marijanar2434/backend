<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Registration\RegistrationDestroyer;

class DestroyRegistrationHandler implements CommandHandler
{
    /**
     * 
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * 
     *
     * @var RegistrationDestroyer
     */
    private  $registrationDestroyer;


    /**
     * 
     *
     * @param RegistrationRepository $registrationRepository
     * @param RegistrationDestroyer $registrationDestroyer
     */
    public function __construct(RegistrationRepository $registrationRepository, RegistrationDestroyer $registrationDestroyer)
    {
        $this->registrationDestroyer = $registrationDestroyer;
        $this->registrationRepository = $registrationRepository;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyRegistrationCommand $command)
    {
        /**
         * @var Registration|null
         */
         $registration = $this->registrationRepository->findById(new Id($command->getId()));

        if (empty($registration)) {
            throw new RegistrationNotFoundException();
        }

        
        $this->registrationDestroyer->destroy($registration);


    }
}

