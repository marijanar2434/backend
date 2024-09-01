<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollaboratorDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;

class CollaboratorCollectionTransformer implements CollectionTransformer
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
         * @var Collaborator $entity
         */
       
        foreach ($entities as $entity) {            

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
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}