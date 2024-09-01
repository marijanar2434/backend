<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\Company;

use App\Common\Application\Transformer\CollectionTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Company\CompanyDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;

class CompanyCollectionTransformer implements CollectionTransformer
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
         * @var Company $entity
         */
        
        foreach ($entities as $entity) {
            $this->data[] = new CompanyDto(
                $entity->getId()->getId(),
                $entity->getName(),
                $entity->getCompanyCode()
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
