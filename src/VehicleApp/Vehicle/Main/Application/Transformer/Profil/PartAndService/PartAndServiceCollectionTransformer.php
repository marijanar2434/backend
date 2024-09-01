<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\PartAndService;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\PartAndService\PartAndServiceDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;

class PartAndServiceCollectionTransformer implements CollectionTransformer
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
         * @var PartAndService $entity
         */
        
        foreach ($entities as $entity) {
            $this->data[] = new PartAndServiceDto(
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
