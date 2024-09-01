<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Maintenance;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;

class MaintenanceItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Maintenance $entity
     */
    public function write($entity): void
    {

        $partString = [];
        foreach ($entity->getPartAndServices() as $part) {
            $partString[] = $part->getName();
        }


        $this->data[] = new MaintenanceDto(
            $entity->getId()->getId(),
            $entity->getType()->getName(),
            $entity->getDate(),
            $entity->getMileage(),
            $entity->getFee(),
            $entity->getTimeOfUser(),
            empty($entity->getUser()) ? null : $entity->getUser()->getFullname(),
            $partString
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
