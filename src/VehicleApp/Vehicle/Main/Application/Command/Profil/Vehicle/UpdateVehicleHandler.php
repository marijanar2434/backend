<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\NotValidDatePeriod;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleCannotBeModifiedException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Vehicle\VehicleCannotBeModified;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class UpdateVehicleHandler implements CommandHandler
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
     * @var ColorRepository
     */
    private $colorRepository;


    public function __construct(VehicleRepository $vehicleRepository, ColorRepository $colorRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->colorRepository = $colorRepository;
    }

    public function __invoke(UpdateVehicleCommand $command)
    {


        /**
         * @var Vehicle|null
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var Color|null
         */
        $color =  $this->colorRepository->findByName($command->getColorId()) == null ? $this->colorRepository->findById(new Id($command->getColorId()))  : $this->colorRepository->findByName($command->getColorId());

        if (empty($color)) {
            throw new ColorNotFoundException();
        }

        if ($vehicle->getVehicleActiveFrom()->format('Y-m-d') > $command->getVehicleActiveTo()->format('Y-m-d')) {
            throw new NotValidDatePeriod("Date vehicle end of active period must be greater than start of active period.");
        }

        $vehicle->updateProperties(
            $command->getPrice(),
            $color,
            $command->getEngineNumber(),
            $command->getChassisNumber(),
            $command->getYearOfProduction(),
            $command->getVehicleActiveFrom(),
            $command->getVehicleActiveTo()
        );

        $this->vehicleRepository->save($vehicle);
    }
}
