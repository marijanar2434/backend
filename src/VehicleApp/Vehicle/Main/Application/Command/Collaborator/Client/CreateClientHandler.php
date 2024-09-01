<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Client;

use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Validator\ClientValidator;

class CreateClientHandler  implements CommandHandler
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
     * @var ClientValidator
     */
    private $clientValidator;



    public function __construct(
        ClientRepository $clientRepository,
        ClientValidator $clientValidator
    ) {
        $this->clientRepository = $clientRepository;
        $this->clientValidator = $clientValidator;
    }

    public function __invoke(CreateClientCommand $command)
    {

        $client = new Client(
            new Id($command->getId()),
            $command->getFullname(),
            $command->getAddress(),
            $command->getPhoneNumber(),
            $command->getEmail(),
            $command->getWebsite()
        );

        /**
         * @var ValidationNotificationHandler
         */
        
        $validationNotificationHandler = $this->clientValidator->validate($client);
        if ($validationNotificationHandler->hasNotifications()) {
            throw ValidationServiceException::fromValidationNotificationHandler($validationNotificationHandler);
        }

        $this->clientRepository->save($client);
    }
}