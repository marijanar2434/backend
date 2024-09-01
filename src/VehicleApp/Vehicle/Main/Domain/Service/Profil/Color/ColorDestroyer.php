<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Color;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Color\ColorIsAttachedToVehicles;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class ColorDestroyer
{

    /**
     * @var ColorRepository
     */
    private  $colorRepository;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * 
     *
     * @param ColorRepository $colorRepository
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(ColorRepository $colorRepository, VehicleRepository $vehicleRepository)
    {
        $this->colorRepository = $colorRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * 
     *
     * @param Color $color
     * @return void
     */
    public function destroy(Color $color): void
    {
        $res = $this->vehicleRepository->countByColorId($color->getId());
        if ($res > 0) {
            throw new ColorIsAttachedToVehicles();
        }

        $this->colorRepository->remove($color);
    }
}
