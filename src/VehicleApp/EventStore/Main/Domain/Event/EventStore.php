<?php

namespace App\VehicleApp\EventStore\Main\Domain\Event;

use App\Common\Domain\Entity;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface EventStore
{
    /**
     * @param int $id
     *
     * @return Entity|null
     */
    public function findById(int $id): ?Entity;

    /**
     * @param DomainEvent $domainEvent
     *
     * @return void
     */
    public function append(DomainEvent $domainEvent): void;

    /**
     * @return void
     */
    public function publish(): void;

    /**
     * @param int $id
     *
     * @return array
     */
    public function allStoredEventsSince(int $id): array;

    /**
     * @param Criteria $criteria
     * 
     * @return RepositoryQueryResult
     */
    public function query(Criteria $criteria): RepositoryQueryResult;
}
