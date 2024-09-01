<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Vehicle\VehicleDestroyer;

class DestroyVehicleHandler implements CommandHandler
{

    /**
     * 
     *
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * 
     *
     * @var VehicleDestroyer
     */
    private  $vehicleDestroyer;


    /**
     * 
     *
     * @param VehicleRepository $vehicleRepository
     * @param VehicleDestroyer $vehicleDestroyer
     */
    public function __construct(VehicleRepository $vehicleRepository, VehicleDestroyer $vehicleDestroyer)
    {
        $this->vehicleDestroyer = $vehicleDestroyer;
        $this->vehicleRepository = $vehicleRepository;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyVehicleCommand $command)
    {


        /**
         * @var Vehicle|null
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getId()));


        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }




        $this->vehicleDestroyer->destroy($vehicle);
    }
}
