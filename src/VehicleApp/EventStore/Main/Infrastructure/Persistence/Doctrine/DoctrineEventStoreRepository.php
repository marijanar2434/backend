<?php

namespace App\VehicleApp\EventStore\Main\Infrastructure\Persistence\Doctrine;

use App\Common\Domain\Entity;
use App\Common\Application\Bus\EventBus;
use App\Common\Domain\Event\DomainEvent;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Envelope;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Common\Domain\Event\StorableDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use Symfony\Component\Serializer\SerializerInterface;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use App\VehicleApp\EventStore\Main\Domain\Event\StoredDomainEvent;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;

class DoctrineEventStoreRepository extends ServiceEntityRepository implements EventStore
{
    /**
     * @var DoctrineCriteriaBuilder
     */
    private $criteriaBuilder;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EventBus
     */
    private $eventBus;

    /**
     * @var DomainEvent[]
     */
    private $domainEventsToPublish = [];

    /**
     * DoctrineEventStoreRepository Constructor
     *
     * @param ManagerRegistry $registry
     * @param string $entityClass
     * @param DoctrineCriteriaBuilder $criteriaBuilder
     * @param SerializerInterface $serializer
     * @param EventBus $eventBus
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, DoctrineCriteriaBuilder $criteriaBuilder, SerializerInterface $serializer, EventBus $eventBus)
    {
        parent::__construct($registry, $entityClass);
        $this->criteriaBuilder = $criteriaBuilder;
        $this->serializer = $serializer;
        $this->eventBus = $eventBus;
    }

    /**
     * @inheritDoc
     */
    public function append(DomainEvent $domainEvent): void
    {
        if ($domainEvent instanceof StorableDomainEvent) {
            $storedEvent = new StoredDomainEvent(
                $domainEvent->getEntityId(),
                $domainEvent->getDomainEventVersion(),
                $domainEvent->getDomainEventType(),
                $this->serializer->serialize($domainEvent, 'json'),
                $domainEvent->getOccurredOn(),
            );
            $this
                ->getEntityManager()
                ->persist($storedEvent);
            $this
                ->getEntityManager()
                ->getUnitOfWork()
                ->computeChangeSet($this->getClassMetadata(), $storedEvent);
        }

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
        return $this->find($id);
    }

    /**
     * @inheritDoc
     */
    public function allStoredEventsSince(int $id): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.id > :id')
            ->setParameters(['id' => $id])
            ->orderBy('e.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * @inheritDoc
     */
    public function query(Criteria $criteria): RepositoryQueryResult
    {
        $doctrineCriteria = $this->criteriaBuilder->build($criteria);

        $queryBuilder = $this->createQueryBuilder('_q')->addCriteria($doctrineCriteria);
        $paginator = new Paginator($queryBuilder);

        return new RepositoryQueryResult(
            iterator_to_array($paginator),
            $doctrineCriteria->getFirstResult() > 0 ? ceil($doctrineCriteria->getFirstResult() / $doctrineCriteria->getMaxResults() + 1) : 1,
            $doctrineCriteria->getMaxResults(),
            count($paginator)
        );
    }
}
