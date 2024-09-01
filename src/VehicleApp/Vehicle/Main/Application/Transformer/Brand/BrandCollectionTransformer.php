<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Brand;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Brand\BrandDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;

class BrandCollectionTransformer implements CollectionTransformer
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
         * @var Brand $entity
         */
        foreach ($entities as $entity) {
            $this->data[] = new BrandDto(
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