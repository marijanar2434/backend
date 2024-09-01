<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FileBadFormatException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\FileNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;

class CreateRegDocumentationHandler implements CommandHandler
{

    /**
     * 
     *
     * @var RegistrationRepository
     */
    private $registrationRepository;

    /**
     * 
     *
     * @var FileInspector
     */
    private  $fileInspector;

    public function __construct(
        RegistrationRepository $registrationRepository,
        FileInspector $fileInspector
    ) {
        $this->registrationRepository = $registrationRepository;
        $this->fileInspector = $fileInspector;
    }

    public function __invoke(CreateRegDocumentationCommand $command)
    {

        /**
         * @var Registration|null
         */
        $registration = $this->registrationRepository->findById(new Id($command->getId()));

        if (empty($registration)) {
            throw new RegistrationNotFoundException();
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


        if ($file == null ||  $file->getSize() == null) {
            throw new FileNotFoundException();
        }

        $registration->addDoc($file);
        $this->registrationRepository->save($registration);
    }
}
