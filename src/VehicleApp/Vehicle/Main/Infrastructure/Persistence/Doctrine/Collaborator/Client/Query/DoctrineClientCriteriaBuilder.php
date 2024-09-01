<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Client\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineClientCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedFields(): array
    {
        return [
            'id',
            'createdOn',
            'updatedOn'
        ];
    }
}