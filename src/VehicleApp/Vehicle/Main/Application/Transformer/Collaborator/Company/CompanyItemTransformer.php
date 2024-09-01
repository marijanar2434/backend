<?php

namespace App\VehicleApp\Vehicle\Main\Application\Transformer\Collaborator\Company;

use App\Common\Application\Transformer\ItemTransformer;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Company\CompanyDto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;

class CompanyItemTransformer implements ItemTransformer
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param Company $entity
     */
    public function write($entity): void
    {

        $this->data = new CompanyDto(
            $entity->getId()->getId(),
            $entity->getName(),
            $entity->getCompanyCode()
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
