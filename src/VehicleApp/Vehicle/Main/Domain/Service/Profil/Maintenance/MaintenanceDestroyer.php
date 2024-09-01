<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;

class MaintenanceDestroyer
{
    /**
     * 
     *
     * @var MaintenanceRepository
     */
    private $maintenanceRepository;

    /**
     * @param MaintenanceRepository $maintenanceRepository
     */
    public function __construct(MaintenanceRepository $maintenanceRepository)
    {
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * 
     *
     * @param Maintenance $maintenance
     * @return void
     */
    public function destroy(Maintenance $maintenance): void
    {
        $this->maintenanceRepository->remove($maintenance);
    }
}
