<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\Client;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Client\ClientDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;

class ClientItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Client $entity
     */
    public function write($entity): void
    {

        $this->data = new ClientDto(
            $entity->getId()->getId(),
            $entity->getFullname(),
            $entity->getAddress(),
            $entity->getPhoneNumber(),
            $entity->getEmail(),
            $entity->getWebsite()
        );
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
