<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\RegistrationValidator;
use DateTimeImmutable;

class CreateRegistrationHandler implements CommandHandler
{
    /**
     * 
     *
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var RegistrationValidator
     */
    private $registrationValidator;

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private  $userVehicleRepository;

    public function __construct(
        RegistrationRepository $registrationRepository,
        VehicleRepository $vehicleRepository,
        UserVehicleRepository $userVehicleRepository,
        RegistrationValidator $registrationValidator
    ) {
        $this->registrationRepository = $registrationRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->userVehicleRepository = $userVehicleRepository;
        $this->registrationValidator = $registrationValidator;
    }

    public function __invoke(CreateRegistrationCommand $command)
    {

        $dateNow = new DateTimeImmutable();
        $dateNow = $dateNow->format("Y-m-d");

        /**
         *@var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));
        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var UserVehicle
         */
        $user = $this->userVehicleRepository->findById(new Id($command->getUserId()));
        if ($user == null) {
            throw new UserNotFoundException();
        }
        
        $registration = new Registration(
            new Id($command->getId()),
            $vehicle,
            $user,
            $command->getRegistrationNumber(),
            $command->getRegistrationStartDate(),
            $command->getRegistrationFee(),
            $command->getTimeOfUser()
        );

        $regExp = $registration->getRegistrationExpire()->format('Y-m-d');
        $regStart = $registration->getRegistrationStartDate()->format('Y-m-d');
       
        
        if($regStart <= $dateNow && $regExp > $dateNow) {
            $registration->setActive(true);
        }

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->registrationValidator->validate($registration);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->registrationRepository->save($registration);
    }
}
