<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Type;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Type\TypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;

class TypeCollectionTransformer implements CollectionTransformer
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
         * @var Type $entity
         */
        foreach ($entities as $entity) {
         
            $this->data[] = new TypeDto(
                $entity->getId()->getId(),
                $entity->getName(),
                $entity->getBrand()->getName(),
                $entity->getCreatedOn()->format(\DateTime::ATOM),
                $entity->getUpdatedOn()->format(\DateTime::ATOM)
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
