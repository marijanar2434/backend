<?php

namespace App\VehicleApp\EventStore\Main\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Events;
use App\Common\Shared\Array\Arr;
use Doctrine\ORM\Event\OnFlushEventArgs;
use App\Common\Domain\RecordingDomainEvents;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class DoctrineEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * DoctrineEventSubscriber Constructor
     *
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::onFlush,
        ];
    }

    /**
     * @param OnFlushEventArgs $args
     * 
     * @return void
     */
    public function onFlush(OnFlushEventArgs $args): void
    {
        $domainEvents = [];

        foreach ($args->getEntityManager()->getUnitOfWork()->getScheduledCollectionUpdates() as $entity) {

            if (!$entity instanceof RecordingDomainEvents) {
                continue;
            }

            foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
                $domainEvents[] = $domainEvent;
            }

            $entity->clearRecordedDomainEvents();
        }

        foreach ($args->getEntityManager()->getUnitOfWork()->getScheduledCollectionDeletions() as $entity) {

            if (!$entity instanceof RecordingDomainEvents) {
                continue;
            }

            foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
                $domainEvents[] = $domainEvent;
            }

            $entity->clearRecordedDomainEvents();
        }

        foreach ($args->getEntityManager()->getUnitOfWork()->getScheduledEntityInsertions() as $entity) {

            if (!$entity instanceof RecordingDomainEvents) {
                continue;
            }

            foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
                $domainEvents[] = $domainEvent;
            }

            $entity->clearRecordedDomainEvents();
        }

        foreach ($args->getEntityManager()->getUnitOfWork()->getScheduledEntityUpdates() as $entity) {

            if (!$entity instanceof RecordingDomainEvents) {
                continue;
            }

            foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
                $domainEvents[] = $domainEvent;
            }

            $entity->clearRecordedDomainEvents();
        }

        foreach ($args->getEntityManager()->getUnitOfWork()->getScheduledEntityDeletions() as $entity) {

            if (!$entity instanceof RecordingDomainEvents) {
                continue;
            }

            foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
                $domainEvents[] = $domainEvent;
            }

            $entity->clearRecordedDomainEvents();
        }

        // Sort by occurredOn
        $domainEvents = Arr::sort($domainEvents, fn ($a, $b) =>  $a->getOccurredOn() <=> $b->getOccurredOn());

        // Store and dispatch
        foreach ($domainEvents as $domainEvent) {
            $this->eventStore->append($domainEvent);
        }
    }
}
