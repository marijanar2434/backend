<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Brand;
            
use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Brand\BrandDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;

class BrandItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Brand $entity
     */
    public function write($entity): void
    {
        $this->data = new BrandDto(
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