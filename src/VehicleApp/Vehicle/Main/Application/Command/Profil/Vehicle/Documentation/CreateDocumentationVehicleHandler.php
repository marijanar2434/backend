<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\ValueObject\File;
use App\Common\Application\Command\CommandHandler;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FileBadFormatException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\FileNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation\CreateDocumentationVehicleCommand;

class CreateDocumentationVehicleHandler implements CommandHandler
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

    public function __invoke(CreateDocumentationVehicleCommand $command)
    {
      
        /**
         * @var Vehicle|null
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getId()));

        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }
       
            
        $file = !empty($command->getDocumentation()) ? new File(
            $command->getDocumentation(),
            $this->fileInspector->getName($command->getDocumentation()),
            $this->fileInspector->getMimeType($command->getDocumentation()),
            $this->fileInspector->getExtension($command->getDocumentation()),
            $this->fileInspector->getSize($command->getDocumentation())
        ) : null;
        
      

        if (!in_array($file->getMimeType(), ["application/pdf", "application/x-pdf"], true)) {
            throw new FileBadFormatException("File with extension [".$file->getExtension()."] can not be uploaded.");
        }

        if($file == null ||  $file->getSize() == null )
        {
            throw new FileNotFoundException();   
        }
       
        $vehicle->addDoc($file);
        $this->vehicleRepository->save($vehicle);
    }
}

