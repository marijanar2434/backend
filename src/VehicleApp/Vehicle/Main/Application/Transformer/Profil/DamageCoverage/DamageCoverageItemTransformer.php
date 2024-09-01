<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Profil\DamageCoverage;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\DamageCoverage\DamageCoverageDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;

class DamageCoverageItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param DamageCoverage $entity
     */
    public function write($entity): void
    {
        
        $this->data = new DamageCoverageDto(
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
