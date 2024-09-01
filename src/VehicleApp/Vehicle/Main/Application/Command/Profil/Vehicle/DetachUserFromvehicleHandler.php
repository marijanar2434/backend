<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class DetachUserFromvehicleHandler implements CommandHandler
{
    /**
     * @var UserVehicleRepository
     */
    private $userVehicleRepository;

    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;


 
    public function __construct(
        UserVehicleRepository $userVehicleRepository,
        VehicleRepository $vehicleRepository
    ) {
        $this->userVehicleRepository = $userVehicleRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DetachUserFromVehicleCommand $command)
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

        $vehicle->detachUser($user);

        $this->vehicleRepository->save($user);
    }
}

