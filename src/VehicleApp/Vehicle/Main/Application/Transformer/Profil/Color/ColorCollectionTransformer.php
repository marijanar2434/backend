<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Color;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Color\ColorDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;

class ColorCollectionTransformer implements CollectionTransformer
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
         * @var Color $entity
         */
        
        foreach ($entities as $entity) {
            $this->data[] = new ColorDto(
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