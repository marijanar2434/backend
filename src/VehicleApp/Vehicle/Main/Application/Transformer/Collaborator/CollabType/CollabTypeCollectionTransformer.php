<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\CollabType;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollabType\CollabTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;

class CollabTypeCollectionTransformer implements CollectionTransformer
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
         * @var CollabType $entity
         */
        foreach ($entities as $entity) {
            $this->data[] = new CollabTypeDto(
                $entity->getId()->getId(),
                $entity->getName()
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
