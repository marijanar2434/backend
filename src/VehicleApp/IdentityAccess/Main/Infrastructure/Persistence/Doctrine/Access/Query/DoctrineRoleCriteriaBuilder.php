<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Access\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineRoleCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedFields(): array
    {
        return [
            'id',
            'name',
            'identifier',
            'createdOn',
            'updatedOn'
        ];
    }
}
