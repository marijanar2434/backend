<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class UpdateMaintenanceHandler implements CommandHandler
{

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private $userRepository;

    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var MaintenanceRepository
     */
    private  $maintenanceRepository;


    public function __construct(
        UserVehicleRepository $userRepository,
        VehicleRepository $vehicleRepository,
        MaintenanceRepository $maintenanceRepository
    ) {
        $this->userRepository = $userRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->maintenanceRepository = $maintenanceRepository;
    }

    public function __invoke(UpdateMaintenanceCommand $command)
    {

        /**
         * @var Maintenance|null
         */

        $maintenance = $this->maintenanceRepository->findById(new Id($command->getId()));

        if (empty($maintenance)) {
            throw new MaintenanceNotFoundException();
        }


        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }



        if ($command->getUserId() != null) {
            /**
             *@var UserVehicle
             */
            $user = $this->userRepository->findByName($command->getUserId()) == null ? $this->userRepository->findById(new Id($command->getUserId()))  : $this->userRepository->findByName($command->getUserId());

            if ($user == null) {
                throw new UserNotFoundException();
            }
        } else {
            $user = null;
        }

        $maintenance->updateProperties(
            $vehicle,
            $command->getDate(),
            $command->getMileage(),
            $command->getFee(),
            $command->getTimeOfUser(),
            $user
        );


        $this->maintenanceRepository->save($maintenance);
    }
}
