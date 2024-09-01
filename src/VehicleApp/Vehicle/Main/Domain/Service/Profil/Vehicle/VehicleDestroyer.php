<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Vehicle;

use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class VehicleDestroyer
{

    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * 
     *
     * @param Vehicle $vehicle
     * @return void
     */
    public function destroy(Vehicle $vehicle): void
    {

        $this->vehicleRepository->remove($vehicle);
    }
}
