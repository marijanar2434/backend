<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceType\MaintenanceTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class CreateMaintenanceHandler implements CommandHandler
{
    /**
     * 
     *
     * @var MaintenanceRepository
     */
    private $maintenanceRepository;

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private $userVehicleRepository;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;


    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private  $partAndServiceRepository;


    public function __construct(
        MaintenanceRepository $maintenanceRepository,
        UserVehicleRepository $userVehicleRepository,
        VehicleRepository $vehicleRepository,
        MaintenanceTypeRepository $maintenanceTypeRepository,
        PartAndServiceRepository $partAndServiceRepository
    ) {
        $this->maintenanceRepository = $maintenanceRepository;
        $this->userVehicleRepository = $userVehicleRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    public function __invoke(CreateMaintenanceCommand $command)
    {

        $objPartAndServices = [];

        $partAndServicesArray = array_unique($command->getPartAndServices());
        foreach ($partAndServicesArray as $part) {

            $obj = $this->partAndServiceRepository->findById(new Id($part));
            if (empty($obj)) {
                throw new PartAndServiceNotFoundException();
            }

            $objPartAndServices[] = $obj;
        }

      
        if ($command->getUserId() != null) {

            /**
             * @var UserVehicle
             */
            $user = $this->userVehicleRepository->findById(new Id($command->getUserId()));

            if ($user == null) {
                throw new UserNotFoundException();
            }
        }
        else
        {
            $user = null;
        }

        /**
         *@var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }

        /**
         *@var MaintenanceType
         */
        $maintenanceType = $this->maintenanceTypeRepository->findById(new Id($command->getMaintenanceTypeId()));

        if ($maintenanceType == null) {
            throw new MaintenanceTypeNotFoundException();
        }


        $maintenance = new Maintenance(
            new Id($command->getId()),
            $maintenanceType,
            $vehicle,
            $command->getDate(),
            $command->getMileage(),
            $command->getFee(),
            $command->getTimeOfUser(),
            $user,
            $objPartAndServices
        );

        $this->maintenanceRepository->save($maintenance);
    }
}
