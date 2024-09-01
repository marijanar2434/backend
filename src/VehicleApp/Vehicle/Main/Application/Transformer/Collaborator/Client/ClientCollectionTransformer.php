<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\Client;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Client\ClientDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;

class ClientCollectionTransformer implements CollectionTransformer
{
    /**
     * @var mixed
     */
    private $data = [];

    /**
     * @inheritDoc
     */
    public function write($entities): void
    {
        $this->data = [];

        /**
         * @var Client $entity
         */
        
        foreach ($entities as $entity) {
           
            $this->data[] = new ClientDto(
                $entity->getId()->getId(),
                $entity->getFullname(),
                $entity->getAddress(),
                $entity->getPhoneNumber(),
                $entity->getEmail(),
                $entity->getWebsite()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}