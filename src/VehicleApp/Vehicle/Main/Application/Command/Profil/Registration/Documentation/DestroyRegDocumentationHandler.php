<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration\Documentation;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;

class DestroyRegDocumentationHandler implements CommandHandler
{
    /**
     * @var RegistrationRepository
     */
    private $registrationRepository;


    public function __construct(
        RegistrationRepository $registrationRepository
    ) {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DestroyRegDocumentationCommand $command)
    {
    
        /**
         * @var Registration|null
         */
        $registration = $this->registrationRepository->findById(new Id($command->getRegistrationId()));

        if (empty($registration)) {
            throw new RegistrationNotFoundException();
        }

        $registration->removeDocumentation(new Id($command->getDocId()));

        $this->registrationRepository->save($registration);
    }
}
