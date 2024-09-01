<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\ClientNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CollaboratorNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\CompanyNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class UpdateCollaboratorHandler implements CommandHandler
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


    public function __construct(
        CollaboratorRepository $collaboratorRepository,
        ClientRepository $clientRepository,
        CompanyRepository $companyRepository
    ) {
        $this->collaboratorRepository = $collaboratorRepository;
        $this->clientRepository = $clientRepository;
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(UpdateCollaboratorCommand $command)
    {

        /**
         * @var Collaborator
         */
        $collaborator = $this->collaboratorRepository->findById(new Id($command->getId()));

        if ($collaborator == null) {
            throw new CollaboratorNotFoundException();
        }

        /**
         *@var Client
         */
        $client = $this->clientRepository->findById(new Id($command->getClient()));


        if ($client == null) {
            throw new ClientNotFoundException();
        }


        /**
         * @var Company
         */
        $company = $this->companyRepository->findById(new Id($command->getCompany()));
        if ($company == null) {
            throw new CompanyNotFoundException();
        }

        $collaborator->updateProperties(
            $client,
            $company
        );

        $this->collaboratorRepository->save($collaborator);
    }
}
