<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\CollabType;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollabType\CollabTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\CollabType\CollabType;

class CollabTypeItemTransformer  implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param CollabType $entity
     */
    public function write($entity): void
    {
        $this->data = new CollabTypeDto(
            $entity->getId()->getId(),
            $entity->getName()
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
