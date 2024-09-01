<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance\MaintenanceNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance\MaintenanceDestroyer;

class DestroyMaintenanceHandler implements CommandHandler
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
     * @var MaintenanceDestroyer
     */
    private $maintenanceDestroyer;


    /**
     * 
     *
     * @param MaintenanceRepository $maintenanceRepository
     * @param MaintenanceDestroyer $maintenanceDestroyer
     */
    public function __construct(MaintenanceRepository $maintenanceRepository, MaintenanceDestroyer $maintenanceDestroyer)
    {
        $this->maintenanceRepository = $maintenanceRepository;
        $this->maintenanceDestroyer = $maintenanceDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyMaintenanceCommand $command)
    {


        /**
         * @var Maintenance|null
         */
        $maintenance = $this->maintenanceRepository->findById(new Id($command->getId()));

        if (empty($maintenance)) {
            throw new MaintenanceNotFoundException();
        }


        $this->maintenanceDestroyer->destroy($maintenance);
    }
}
