<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\ClientNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CollabTypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CompanyNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabTypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\CollaboratorValidator;

class CreateCollaboratorHandler implements CommandHandler
{
    /**
     * 
     *
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * 
     *
     * @var ClientRepository
     */
    private $clientRepository;


    /**
     * 
     *
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * 
     *
     * @var CollabTypeRepository
     */
    private $collabTypeRepository;

    /**
     * 
     *
     * @var collaboratorValidator
     */
    private $collaboratorValidator;
 

    public function __construct(
        CollaboratorRepository $collaboratorRepository,
        ClientRepository $clientRepository,
        CompanyRepository $companyRepository,
        CollabTypeRepository $collabTypeRepository,
        CollaboratorValidator $collaboratorValidator
    ) {
        $this->collaboratorRepository = $collaboratorRepository;
        $this->clientRepository = $clientRepository;
        $this->companyRepository = $companyRepository;
        $this->collabTypeRepository = $collabTypeRepository;
        $this->collaboratorValidator = $collaboratorValidator;
    }

    public function __invoke(CreateCollaboratorCommand $command)
    {

        $objTypes = [];

        $typesArray = array_unique($command->getTypes());
        foreach ($typesArray as $type) {

            $obj = $this->collabTypeRepository->findById(new Id($type));
            if (empty($obj)) {
                throw new CollabTypeNotFoundException();
            }

            $objTypes[] = $obj;
        }

        /**
         *@var Client
         */
        $client = $this->clientRepository->findById(new Id($command->getClient()));

        if ($client == null) {
            throw new ClientNotFoundException();
        }

        /**
         *@var Company|null
         */
        $company = $this->companyRepository->findById(new Id($command->getCompany()));
        if (empty($company)) {
            throw new CompanyNotFoundException();
        }

        $collaborator = new Collaborator(
            new Id($command->getId()),
            $client,
            $company,
            $objTypes
        );


        /**
         * @var ValidationNotificationHandler
         */
        $validationNotificationHandler = $this->collaboratorValidator->validate($collaborator);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }


        $this->collaboratorRepository->save($collaborator);
    }
}
