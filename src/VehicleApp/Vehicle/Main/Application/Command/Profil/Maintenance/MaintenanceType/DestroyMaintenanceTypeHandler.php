<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceType\MaintenanceTypeCannotBeDeletedException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceType\MaintenanceTypeIsAttachedToMaintenanceException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceType\MaintenanceTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Maintenance\MaintenanceType\MaintenanceTypeCannotBedeleted;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Maintenance\MaintenanceType\MaintenanceTypeIsAttachedToMaintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance\MaintenanceType\MaintenanceTypeDestroyer;

class DestroyMaintenanceTypeHandler implements CommandHandler
{

    /**
     * 
     *
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;

    /**
     * 
     *
     * @var MaintenanceTypeDestroyer
     */
    private $maintenanceTypeDestroyer;


    /**
     * 
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     * @param MaintenanceTypeDestroyer $maintenanceTypeDestroyer
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository, MaintenanceTypeDestroyer $maintenanceTypeDestroyer)
    {

        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
        $this->maintenanceTypeDestroyer = $maintenanceTypeDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyMaintenanceTypeCommand $command)
    {

        /**
         * @var MaintenanceType|null
         */
          $maintenanceType = $this->maintenanceTypeRepository->findById(new Id($command->getId()));


        if (empty($maintenanceType)) {
            throw new MaintenanceTypeNotFoundException();
        }

        try {     
            $this->maintenanceTypeDestroyer->destroy($maintenanceType);
        } catch (MaintenanceTypeIsAttachedToMaintenance) {
            throw new MaintenanceTypeIsAttachedToMaintenanceException();
        }
    }
}
