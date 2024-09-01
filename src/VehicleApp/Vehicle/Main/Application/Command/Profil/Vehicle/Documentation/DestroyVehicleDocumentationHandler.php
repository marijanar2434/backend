<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation\DestroyVehicleDocumentationCommand;

class DestroyVehicleDocumentationHandler implements CommandHandler
{
    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;

 
    public function __construct(
        VehicleRepository $vehicleRepository
    ) {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DestroyVehicleDocumentationCommand $command)
    {
        
        /**
         * @var Vehicle|null
         */
         $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

        $vehicle->removeDocumentation(new Id($command->getDocId()));

        $this->vehicleRepository->save($vehicle);

    }
}