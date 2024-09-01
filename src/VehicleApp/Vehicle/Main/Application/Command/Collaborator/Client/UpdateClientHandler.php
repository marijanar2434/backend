<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Client;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator\ClientNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;

class UpdateClientHandler implements CommandHandler
{
    /**
     * 
     *
     * @var ClientRepository
     */
    private $clientRepository;


    public function __construct(
        ClientRepository $clientRepository
    ) {
        $this->clientRepository = $clientRepository;
    }

    public function __invoke(UpdateClientCommand $command)
    {

        /**
         * @var Client|null
         */

        $client = $this->clientRepository->findById(new Id($command->getId()));


        if (empty($client)) {
            throw new ClientNotFoundException();
        }

        $client->updateProperties(
            $command->getFullname(),
            $command->getAddress(),
            $command->getPhoneNumber(),
            $command->getEmail(),
            $command->getWebsite()
        );

        $this->clientRepository->save($client);
    }
}
