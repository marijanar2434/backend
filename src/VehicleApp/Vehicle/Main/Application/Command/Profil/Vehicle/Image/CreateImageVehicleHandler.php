<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\ValueObject\File;
use App\Common\Application\Command\CommandHandler;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FileBadFormatException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\FileNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image\CreateImageVehicleCommand;

class CreateImageVehicleHandler implements CommandHandler
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
     * @var FileInspector
     */
    private  $fileInspector;

    public function __construct(
        VehicleRepository $vehicleRepository,
        FileInspector $fileInspector
    ) {
        $this->vehicleRepository = $vehicleRepository;
        $this->fileInspector = $fileInspector;
    }

    public function __invoke(CreateImageVehicleCommand $command)
    {

        /**
         * @var Vehicle|null
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }


        $file = !empty($command->getImage()) ? new File(
            $command->getImage(),
            $this->fileInspector->getName($command->getImage()),
            $this->fileInspector->getMimeType($command->getImage()),
            $this->fileInspector->getExtension($command->getImage()),
            $this->fileInspector->getSize($command->getImage())
        ) : null;


        if (!in_array($file->getMimeType(), ["image/jpeg", "image/png", "image/jpg"], true)) {
            throw new FileBadFormatException("File with extension [" . $file->getExtension() . "] can not be uploaded.");
        }

        
        if ($file == null ||  $file->getSize() == null) {
            throw new FileNotFoundException();
        }

        $vehicle->addImage($file);

        $this->vehicleRepository->save($vehicle);
    }
}
