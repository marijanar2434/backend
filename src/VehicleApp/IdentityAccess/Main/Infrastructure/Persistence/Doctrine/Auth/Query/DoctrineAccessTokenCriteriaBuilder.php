<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineAccessTokenCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedFields(): array
    {
        return [
            'id',
            'identifier',
            'createdOn',
            'updatedOn'
        ];
    }
}
