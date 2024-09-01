<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Type;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Type\TypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;

class TypeItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Type $entity
     */
    public function write($entity): void
    {
        $this->data = new TypeDto(
            $entity->getId()->getId(),
            $entity->getName(),
            $entity->getBrand()->getName(),
            $entity->getCreatedOn()->format(\DateTime::ATOM),
            $entity->getUpdatedOn()->format(\DateTime::ATOM)
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