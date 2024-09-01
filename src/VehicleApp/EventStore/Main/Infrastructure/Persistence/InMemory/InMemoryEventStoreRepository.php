<?php

namespace App\VehicleApp\EventStore\Main\Infrastructure\Persistence\InMemory;

use App\Common\Domain\Entity;
use App\Common\Application\Bus\EventBus;
use App\Common\Domain\Event\DomainEvent;
use Symfony\Component\Messenger\Envelope;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\Common\Collections\ArrayCollection;
use App\Common\Domain\Event\PublishableDomainEvent;
use Symfony\Component\Serializer\SerializerInterface;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use App\VehicleApp\EventStore\Main\Domain\Event\StoredDomainEvent;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class InMemoryEventStoreRepository implements EventStore
{
    /**
     * @var ArrayCollection
     */
    protected $events;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var EventBus
     */
    protected $eventBus;

    /**
     * @var DomainEvent[]
     */
    private $domainEventsToPublish = [];

    /**
     * InMemoryEventStoreRepository Constructor
     *
     * @param SerializerInterface $serializer
     * @param EventBus $eventBus
     */
    public function __construct(SerializerInterface $serializer, EventBus $eventBus)
    {
        $this->events = new ArrayCollection();
        $this->serializer = $serializer;
        $this->eventBus = $eventBus;
    }

    /**
     * @inheritDoc
     */
    public function append(DomainEvent $domainEvent): void
    {
        $storedEvent = new StoredDomainEvent(
            $domainEvent->getEntityId(),
            $domainEvent->getDomainEventVersion(),
            $domainEvent->getDomainEventType(),
            $this->serializer->serialize($domainEvent, 'json'),
            $domainEvent->getOccurredOn(),
        );

        $this->events[count($this->events) + 1] = $storedEvent;

        if ($domainEvent instanceof PublishableDomainEvent) {
            $this->domainEventsToPublish[] = $domainEvent;
        }
    }

    /**
     * @inheritDoc
     */
    public function publish(): void
    {
        foreach ($this->domainEventsToPublish as $domainEvent) {
            $this->eventBus->handle(
                (new Envelope(
                    $domainEvent
                ))->with(new DispatchAfterCurrentBusStamp())
            );
        }

        $this->domainEventsToPublish = [];
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Entity
    {
        if (!isset($this->events[$id])) {
            return null;
        }

        return $this->events[$id];
    }

    /**
     * @inheritDoc
     */
    public function allStoredEventsSince(int $id): array
    {
        return $this->events->filter(fn ($e) => $e->getId() >= $id)->toArray();
    }

    /**
     * @inheritDoc
     */
    public function query(Criteria $criteria): RepositoryQueryResult
    {
        return new RepositoryQueryResult(
            $this->events->toArray(),
            1,
            count($this->events),
            count($this->events)
        );
    }
}
