<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\PartAndService;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\PartAndService\PartAndServiceDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;

class PartAndServiceItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param PartAndService $entity
     */
    public function write($entity): void
    {
        $this->data = new PartAndServiceDto(
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
