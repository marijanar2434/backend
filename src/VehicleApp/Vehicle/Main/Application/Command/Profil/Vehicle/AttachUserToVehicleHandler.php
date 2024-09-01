<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class AttachUserToVehicleHandler implements CommandHandler
{
    /**
     * @var VehicleRepository
     */
    private   $vehicleRepository;

    /**
     * @var UserVehicleRepository
     */
    private  $userVehicleRepository;


    /**
     * AttachRoleToUserHandler Constructor
     *
     * @param VehicleRepository $vehicleRepository
     * @param UserVehicleRepository $userVehicleRepository
     */
    public function __construct(
        VehicleRepository $vehicleRepository,
        UserVehicleRepository $userVehicleRepository
    ) {
        $this->vehicleRepository = $vehicleRepository;
        $this->userVehicleRepository = $userVehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(AttachUserToVehicleCommand $command)
    {
        /**
         * @var Vehicle|null
         */

        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var UserVehicle|null
         */
        
        $user = $this->userVehicleRepository->findById(new Id($command->getUserId()));

        if (empty($user)) {
            throw new UserNotFoundException();
        }

        if (!$vehicle->hasUser($user)) {
            $vehicle->attachUser($user);
        }

        $this->vehicleRepository->save($user);
    }
}

