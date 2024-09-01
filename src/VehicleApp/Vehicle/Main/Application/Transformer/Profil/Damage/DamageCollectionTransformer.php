<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Damage;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Damage\DamageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;

class DamageCollectionTransformer implements CollectionTransformer
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
         * @var Damage $entity
         */
        foreach ($entities as $entity) {

            $partString = [];
            foreach ($entity->getPartAndServices() as $part) {
                $partString[] = $part->getName();
            }
            $this->data[] = new DamageDto(
                $entity->getId()->getId(),
                $entity->getDescription(),
                $entity->getDamageCoverage()->getName(),
                $entity->getDate(),
                $entity->getFee(),
                empty($entity->getUser()) ? null : $entity->getUser()->getFullname(),
                $entity->getTimeOfUser(),
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
