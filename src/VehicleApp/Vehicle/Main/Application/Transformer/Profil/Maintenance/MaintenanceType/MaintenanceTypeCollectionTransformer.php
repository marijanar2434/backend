<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceType\MaintenanceTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;

class MaintenanceTypeCollectionTransformer implements CollectionTransformer
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
         * @var MaintenanceType $entity
         */
        foreach ($entities as $entity) {
           
            $this->data[] = new MaintenanceTypeDto(
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
