<?php

namespace App\Common\Infrastructure\Persistence\InMemory;

use BadMethodCallException;
use App\Common\Domain\Entity;
use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\RecordingDomainEvents;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\Common\Collections\ArrayCollection;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;

abstract class InMemoryRepository implements Repository
{
    /**
     * @var ArrayCollection
     */
    protected $entities;
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * InMemoryRepository Constructor
     *
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        $this->entities = new ArrayCollection();
        $this->eventStore = $eventStore;
    }

    /**
     * @inheritDoc
     */
    public function findById(Id $id): ?Entity
    {
        if (!isset($this->entities[$id->getId()])) {
            return null;
        }

        return $this->entities[$id->getId()];
    }

    /**
     * @inheritDoc
     */
    public function save(Entity $entity): void
    {
        if (!isset($this->entities[$entity->getId()->getId()])) {
            $this->entities[$entity->getId()->getId()] = $entity;
        }

        if ($entity instanceof RecordingDomainEvents) {
            $this->appendDomainEvents($entity);
        }
    }

    /**
     * @inheritDoc
     */
    public function flush(?Entity $entity = null): void
    {
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function remove(Entity $entity): void
    {
        foreach ($this->entities as $key => $u) {
            if ($key === $entity->getId()->getId()) {
                unset($this->entities[$key]);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function removeAll(): void
    {
        $this->entities->clear();
    }

    /**
     * @inheritDoc
     */
    public function nextIdentity(): Id
    {
        return new Id();
    }

    /**
     * @inheritDoc
     */
    public function query(Criteria $criteria): RepositoryQueryResult
    {
        throw new BadMethodCallException();
    }

    /**
     * @param RecordingDomainEvents $entity
     * 
     * @return void
     */
    private function appendDomainEvents(RecordingDomainEvents $entity): void
    {
        foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
            $this->eventStore->append($domainEvent);
        }

        $entity->clearRecordedDomainEvents();
    }

    /**
     * @inheritDoc
     */
    public function forEach(callable $callback, ?Criteria $criteria = null): void
    {
        throw new BadMethodCallException();
    }

    /**
     * @inheritDoc
     */
    public function toIterable(?Criteria $criteria = null): iterable
    {
        throw new BadMethodCallException();
    }
}
