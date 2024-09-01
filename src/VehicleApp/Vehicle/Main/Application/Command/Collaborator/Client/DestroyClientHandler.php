<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Client;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\ClientIsAttachedToCollaboratorException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\ClientNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Exception\Client\ClientIsAttachedToCollaborators;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Client\ClientDestroyer;

class DestroyClientHandler implements CommandHandler
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
     * @var ClientDestroyer
     */
    private $clientDestroyer;


    /**
     * 
     *
     * @param ClientRepository $clientRepository
     * @param ClientDestroyer $clientDestroyer
     */
    public function __construct(ClientRepository $clientRepository, ClientDestroyer $clientDestroyer)
    {
        $this->clientRepository = $clientRepository;
        $this->clientDestroyer = $clientDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyClientCommand $command)
    {
        /**
         * @var Client|null
         */
       
        $client = $this->clientRepository->findById(new Id($command->getId()));

        if (empty($client)) {
            throw new ClientNotFoundException();
        }


        try {   
            $this->clientDestroyer->destroy($client);
        } catch (ClientIsAttachedToCollaborators) {
            throw new ClientIsAttachedToCollaboratorException();
        }
    }
}

