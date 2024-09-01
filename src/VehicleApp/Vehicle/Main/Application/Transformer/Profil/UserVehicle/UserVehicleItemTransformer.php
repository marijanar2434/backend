<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\UserVehicle;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\UserVehicle\UserVehicleDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;

class UserVehicleItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param UserVehicle $entity
     */
    
    public function write($entity): void
    {
        $this->data[] = new UserVehicleDto(
            $entity->getId()->getId(),
            $entity->getFullname(),
            $entity->getUsername(),
            $entity->getEmail()
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