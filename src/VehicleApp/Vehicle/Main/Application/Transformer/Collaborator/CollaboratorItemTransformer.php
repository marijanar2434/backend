<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollaboratorDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;

class CollaboratorItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Collaborator $entity
     */
    public function write($entity): void
    {

        $types = [];
        foreach ($entity->getTypes() as $type) {
            $types[] = $type->getName();
        }

        $this->data[] = new CollaboratorDto(
            $entity->getId()->getId(),
            $entity->getCompany()->getName(),
            $entity->getCompany()->getCompanyCode(),
            $entity->getClient()->getFullname(),
            $entity->getClient()->getAddress(),
            $entity->getClient()->getPhoneNumber(),
            $entity->getClient()->getEmail(),
            $entity->getClient()->getWebsite(),
            $types
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
