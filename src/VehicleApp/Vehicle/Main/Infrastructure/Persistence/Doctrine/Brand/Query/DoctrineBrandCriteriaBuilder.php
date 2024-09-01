<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Brand\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineBrandCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedFields(): array
    {
        return [
            'id',
            'name',
            'createdOn',
            'updatedOn'
        ];
    }
}
