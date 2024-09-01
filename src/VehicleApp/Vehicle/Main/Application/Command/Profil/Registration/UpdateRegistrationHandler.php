<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationCannotBeModifiedException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\RegistrationValidator;

class UpdateRegistrationHandler implements CommandHandler
{

    /**
     * 
     *
     * @var RegistrationRepository
     */
    private $registrationRepository;


    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private   $userVehicleRepository;

    /**
     * 
     *
     * @var RegistrationValidator
     */
    private    $registrationValidator;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    public function __construct(
        RegistrationRepository $registrationRepository,
        RegistrationValidator $registrationValidator,
        UserVehicleRepository $userVehicleRepository,
        VehicleRepository $vehicleRepository
    ) {
        $this->registrationRepository = $registrationRepository;
        $this->registrationValidator = $registrationValidator;
        $this->userVehicleRepository = $userVehicleRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function __invoke(UpdateRegistrationCommand $command)
    {
        /**
         * @var Registration|null
         */
        $registration = $this->registrationRepository->findById(new Id($command->getId()));

        if (empty($registration)) {
            throw new RegistrationNotFoundException();
        }

        /**
         * @var UserVehicle
         */
        $user = $this->userVehicleRepository->findByName($command->getUserId()) == null ? $this->userVehicleRepository->findById(new Id($command->getUserId()))  : $this->userVehicleRepository->findByName($command->getUserId());

        if ($user == null) {
            throw new UserNotFoundException();
        }

        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));


        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }


        $registration->updateProperties(
            $user,
            $vehicle,
            $command->getRegistrationStartDate(),
            $command->getRegistrationFee(),
            $command->getTimeOfUser(),
            $command->getRegistrationNumber()
        );


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
