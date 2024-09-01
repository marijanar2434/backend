<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceType\MaintenanceTypeDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;

class MaintenanceTypeItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param MaintenanceType $entity
     */
    public function write($entity): void
    {
        
        $this->data[] = new MaintenanceTypeDto(
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

