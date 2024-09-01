<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Client;

use App\VehicleApp\Vehicle\Main\Domain\Exception\Client\ClientIsAttachedToCollaborators;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollaboratorRepository;

class ClientDestroyer
{
    /**
     * 
     *
     * @var ClientRepository
     */
    private $clientRepository;


    /**
     * 
     *
     * @var CollaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * 
     *
     * @param ClientRepository $clientRepository
     * @param CollaboratorRepository $collaboratorRepository
     */
    public function __construct(ClientRepository $clientRepository, CollaboratorRepository $collaboratorRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->collaboratorRepository = $collaboratorRepository;
    }

    /**
     * 
     *
     * @param Client $client
     * @return void
     */
    public function destroy(Client $client): void
    {

        $res = $this->collaboratorRepository->countByClientId($client->getId());
        if ($res > 0) {
            throw new ClientIsAttachedToCollaborators();
        }

        $this->clientRepository->remove($client);
    }
}
