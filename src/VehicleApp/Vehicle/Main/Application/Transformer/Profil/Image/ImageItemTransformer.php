<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Image;


use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Image\ImageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image;

class ImageItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;


    public function write($entity): void
    {   
        $this->data = new ImageDto(
            $entity,
            $entity->getImage()->getFile()
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

