<?php

namespace App\Common\Infrastructure\Persistence\Doctrine;

use App\Common\Domain\Entity;
use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;
use Doctrine\Persistence\ManagerRegistry;
use App\Common\Domain\RecordingDomainEvents;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\EventStore\Main\Domain\Event\EventStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;

abstract class DoctrineRepository extends ServiceEntityRepository implements Repository
{
    /**
     * @var EventStore
     */
    protected $eventStore;

    /**
     * @var DoctrineCriteriaBuilder
     */
    protected $criteriaBuilder = null;

    /**
     * @param ManagerRegistry $registry
     * @param string $entityClass
     * @param EventStore $eventStore
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, EventStore $eventStore)
    {
        parent::__construct($registry, $entityClass);

        $this->eventStore = $eventStore;
    }

    /**
     * @inheritDoc
     */
    public function findById(Id $id): ?Entity
    {
        return $this->find($id);
    }

    /**
     * @inheritDoc
     */
    public function save(Entity $entity): void
    {
        $this->getEntityManager()->persist($entity);

        if ($entity instanceof RecordingDomainEvents) {
            $this->appendDomainEvents($entity);
        }
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->getEntityManager()->clear();
    }

    /**
     * @inheritDoc
     */
    public function remove(Entity $entity): void
    {
        $this->getEntityManager()->remove($entity);

        if ($entity instanceof RecordingDomainEvents) {
            $this->appendDomainEvents($entity);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeAll(): void
    {
        $this
            ->createQueryBuilder('d')
            ->delete()
            ->getQuery()
            ->execute();
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
     * @param DoctrineCriteriaBuilder $criteriaBuilder
     *
     * @return void
     */
    public function setCriteriaBuilder(DoctrineCriteriaBuilder $criteriaBuilder): void
    {
        $this->criteriaBuilder = $criteriaBuilder;
    }

    /**
     * @inheritDoc
     */
    public function forEach(callable $callback, ?Criteria $criteria = null): void
    {
        $queryBuilder = $this->createQueryBuilder('_q');

        if (!empty($criteria)) {
            $queryBuilder->addCriteria($this->criteriaBuilder->build($criteria));
        }

        foreach ($queryBuilder->getQuery()->toIterable() as $iteratee) {
            $callback($iteratee);
        }
    }

    /**
     * @inheritDoc
     */
    public function toIterable(?Criteria $criteria = null): iterable
    {
        $queryBuilder = $this->createQueryBuilder('_q');

        if (!empty($criteria)) {
            $queryBuilder->addCriteria($this->criteriaBuilder->build($criteria));
        }

        return $queryBuilder->getQuery()->toIterable();
    }
}
