<?php

namespace App\VehicleApp\EventStore\Main\Infrastructure\Persistence\Doctrine\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;
use App\Common\Infrastructure\Persistence\Query\CriteriaBuilder;

class DoctrineEventStoreCriteriaBuilder extends DoctrineCriteriaBuilder implements CriteriaBuilder
{
    /**
     * @return array
     */
    protected function getSupportedFields(): array
    {
        return [
            'id',
            'type',
            'version',
            'body',
            'occurredOn'
        ];
    }
}
