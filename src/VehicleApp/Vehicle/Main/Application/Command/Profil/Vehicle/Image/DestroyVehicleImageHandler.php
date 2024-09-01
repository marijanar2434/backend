<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use App\Common\Domain\ValueObject\Id;
use App\Common\Application\Command\CommandHandler;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\Image;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\ImageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\ImageNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image\DestroyVehicleImageCommand;

class DestroyVehicleImageHandler implements CommandHandler
{
    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;

 
    public function __construct(
        ImageRepository $imageRepository,
        VehicleRepository $vehicleRepository
    ) {
        $this->imageRepository = $imageRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DestroyVehicleImageCommand $command)
    {
        /**
         * @var Vehicle|null
         */
         $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var Image|null
         */
        $image = $this->imageRepository->findById(new Id($command->getImageId()));

       
        if (empty($image)) {
           throw new ImageNotFoundException();
        }

        $vehicle->removeImage(new Id($command->getImageId()));

        $this->vehicleRepository->save($vehicle);

    }
}

