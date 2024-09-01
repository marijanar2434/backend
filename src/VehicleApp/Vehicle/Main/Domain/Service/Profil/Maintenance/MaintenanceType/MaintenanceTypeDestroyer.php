<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Maintenance\MaintenanceType;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Maintenance\MaintenanceType\MaintenanceTypeIsAttachedToMaintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;

class MaintenanceTypeDestroyer
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
     * @var MaintenanceRepository
     */
    private  $maintenanceRepository;

    /**
     * 
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     * @param MaintenanceRepository $maintenanceRepository
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository, MaintenanceRepository $maintenanceRepository)
    {
        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * 
     *
     * @param MaintenanceType $maintenanceType
     * @return void
     */
    public function destroy(MaintenanceType $maintenanceType): void
    {

        $res = $this->maintenanceRepository->countByMaintenanceTypeId($maintenanceType->getId());

        if($res > 0)
        {
            throw new MaintenanceTypeIsAttachedToMaintenance();
        }

        $this->maintenanceTypeRepository->remove($maintenanceType);
    }
}
