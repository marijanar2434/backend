<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Vehicle;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle\VehicleImageDto;

class VehicleImageItemTransformer  implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param string $entity
     */
    public function write($entity): void
    {
        $this->data = new VehicleImageDto(
            $entity
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

