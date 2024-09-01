<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Client\Specification\UniqueNameSpecification;

class ClientValidator extends Validator
{
    /**
     * @var ClientRepository
     */ 
    private $clientRepository;

    /**
     * BrandValidator Constructor
     *
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Client with email {{ email }} already exists.',
                ['{{ email }}' => $object->getEmail()],
                'email'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(Client $client): bool
    {
        return (new UniqueNameSpecification($this->clientRepository))->isSatisfiedBy($client);
    }
}

