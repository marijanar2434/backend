<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Color;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Color\ColorDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;

class ColorItemTransformer  implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Color $entity
     */
    public function write($entity): void
    {
        $this->data = new ColorDto(
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