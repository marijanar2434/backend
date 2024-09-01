<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Image;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Image\ImageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\Image;

class ImageCollectionTransformer implements CollectionTransformer
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
         * @var Image $entity
         */
        foreach ($entities as $entity) {

            $this->data[] = new ImageDto(
                $entity->getId()->getId(),
                $entity->getImage()->getFile(),
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

