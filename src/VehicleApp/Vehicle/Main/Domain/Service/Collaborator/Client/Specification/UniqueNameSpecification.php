<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Collaborator\Client\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\ClientRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * UniqueNameSpecification Constructor
     *
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param  Client$object
     * 
     * @return boolean
     */
    public function isSatisfiedBy($object): bool
    {
        $client = $this->clientRepository->findByEmail($object->getEmail());

        return $client === null || $object->getId()->equals($client->getId());
    }
}


