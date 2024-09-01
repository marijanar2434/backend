<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\PartAndService;

use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceIsAttachedToDamageException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartIsAttachedToMaintenanceException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;

class PartAndServiceDestroyer
{
    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;




    /**
     * 
     *
     * @var MaintenanceRepository
     */
    private  $maintenanceRepository;

    /**
     * 
     *
     * @var DamageRepository
     */
    private DamageRepository $damageRepository;

    /**
     * 
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     * @param MaintenanceRepository $maintenanceRepository
     * @param DamageRepository $damageRepository
     */
    public function __construct(
        PartAndServiceRepository $partAndServiceRepository,
        MaintenanceRepository $maintenanceRepository,
        DamageRepository $damageRepository
    ) {
        $this->partAndServiceRepository = $partAndServiceRepository;
        $this->maintenanceRepository = $maintenanceRepository;
        $this->damageRepository = $damageRepository;
    }

    /**
     * 
     *
     * @param PartAndService $partAndService
     * @return void
     */
    public function destroy(PartAndService $partAndService): void
    {
        $maintenanceRes = $this->maintenanceRepository->countByParAndServiceId($partAndService->getId());
        if ($maintenanceRes > 0) {
            throw new PartIsAttachedToMaintenanceException();
        }

        $damageRes = $this->damageRepository->countByParAndServiceId($partAndService->getId());

        if ($damageRes > 0) {
            throw new PartAndServiceIsAttachedToDamageException();
        }


        $this->partAndServiceRepository->remove($partAndService);
    }
}
