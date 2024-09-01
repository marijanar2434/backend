<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\DamageCoverage;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\DamageCoverage\DamageCoverageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;

class DamageCoverageCollectionTransformer implements CollectionTransformer
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
         * @var DamageCoverage $entity
         */
        
        foreach ($entities as $entity) {
            $this->data[] = new DamageCoverageDto(
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
