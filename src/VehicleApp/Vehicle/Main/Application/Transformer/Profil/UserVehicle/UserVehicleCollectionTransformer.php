<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\UserVehicle;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\UserVehicle\UserVehicleDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;

class UserVehicleCollectionTransformer  implements CollectionTransformer
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
         * @var UserVehicle $entity
         */
        foreach ($entities as $entity) {
        
            $this->data[] = new UserVehicleDto(
                $entity->getId()->getId(),
                $entity->getFullname(),
                $entity->getUsername(),
                $entity->getEmail()
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
