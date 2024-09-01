<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\NotValidDatePeriod;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\VehicleValidator;

class CreateVehicleHandler implements CommandHandler
{
    private VehicleRepository $vehicleRepository;


    private TypeRepository $typeRepository;

    private VehicleValidator $vehicleValidator;


    private ColorRepository $colorRepository;

    public function __construct(VehicleRepository $vehicleRepository, TypeRepository $typeRepository, ColorRepository $colorRepository, VehicleValidator $vehicleValidator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->typeRepository = $typeRepository;
        $this->vehicleValidator = $vehicleValidator;
        $this->colorRepository = $colorRepository;
    }

    public function __invoke(CreateVehicleCommand $command)
    {
        if ($command->getVehicleActiveTo() != null) {
            $validDate = $command->getVehicleActiveTo() > $command->getVehicleActiveFrom();
            if (!$validDate)
                throw new NotValidDatePeriod();
        }


        /**
         *@var Type|null
         */
        $type = $this->typeRepository->findById(new Id($command->getTypeId()));
        if (empty($type)) {
            throw new TypeNotFoundException();
        }

        /**
         *@var Color|null
         */
        $color = $this->colorRepository->findById(new Id($command->getColorId()));
        if (empty($color)) {
            throw new ColorNotFoundException();
        }

        $vehicle = new Vehicle(
            new Id($command->getId()),
            $type,
            $command->getPrice(),
            $color,
            $command->getEngineNumber(),
            $command->getChassisNumber(),
            $command->getYearOfProduction(),
            $command->getVehicleActiveFrom(),
            $command->getVehicleActiveTo()
        );

        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->vehicleValidator->validate($vehicle);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->vehicleRepository->save($vehicle);
    }
}
