<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceType\MaintenanceTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;

class UpdateMaintenanceTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;



    public function __construct(
        MaintenanceTypeRepository $maintenanceTypeRepository
    ) {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
    }

    public function __invoke(UpdateMaintenanceTypeCommand $command)
    {

        /**
         * @var MaintenanceType|null
         */
         $maintenanceType = $this->maintenanceTypeRepository->findById(new Id($command->getId()));
       
        if (empty($maintenanceType)) {
            throw new MaintenanceTypeNotFoundException();
        }

        
         $maintenanceType->updateProperties($command->getName());
   
        $this->maintenanceTypeRepository->save($maintenanceType);
    }
}
