<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Maintenance\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineMaintenanceCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
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