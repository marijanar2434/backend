<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Maintenance;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;

class MaintenanceCollectionTransformer implements CollectionTransformer
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
         * @var Maintenance $entity
         */
        foreach ($entities as $entity) {
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
    }

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
