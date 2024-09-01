<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\Damage;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Damage\DamageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;

class DamageItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Damage $entity
     */

    public function write($entity): void
    {
        $partString = [];
        foreach ($entity->getPartAndServices() as $part) {
            $partString[] = $part->getName();
        }
        
        $this->data = new DamageDto(
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

    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return $this->data;
    }
}
