<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Access;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\RoleRepository;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineRoleRepository extends DoctrineRepository implements RoleRepository
{
    /**
     * @inheritDoc
     */
    public function findByIdentifier(string $id): ?Role
    {
        return $this
            ->createQueryBuilder('r')
            ->select('r')
            ->where('r.identifier = :identifier')
            ->setParameter('identifier', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?Role
    {
        return $this
            ->createQueryBuilder('r')
            ->select('r')
            ->where('r.name = :name')
            ->setParameter('name', $name)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function queryAttachedToUser(Id $userId, Criteria $criteria): RepositoryQueryResult
    {
        $doctrineCriteria = $this->criteriaBuilder->build($criteria);
        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->select('r')
            ->innerJoin('r.users', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->addCriteria($doctrineCriteria);

        $paginator = new Paginator($queryBuilder);

        return new RepositoryQueryResult(
            iterator_to_array($paginator),
            $doctrineCriteria->getFirstResult() > 0 ? ceil($doctrineCriteria->getFirstResult() / $doctrineCriteria->getMaxResults() + 1) : 1,
            $doctrineCriteria->getMaxResults(),
            count($paginator)
        );
    }

    /**
     * @inheritDoc
     */
    public function queryNotAttachedToUser(Id $userId, Criteria $criteria): RepositoryQueryResult
    {
        $doctrineCriteria = $this->criteriaBuilder->build($criteria);

        $subQueryBuilder = $this->createQueryBuilder('r1')
            ->select('r1.id')
            ->innerJoin('r1.users', 'u1')
            ->where('u1.id = :userId');

        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder
            ->select('r')
            ->where($queryBuilder->expr()->notIn('r.id', $subQueryBuilder->getDQL()))
            ->setParameter('userId', $userId)
            ->addCriteria($doctrineCriteria);

        $paginator = new Paginator($queryBuilder);

        return new RepositoryQueryResult(
            iterator_to_array($paginator),
            $doctrineCriteria->getFirstResult() > 0 ? ceil($doctrineCriteria->getFirstResult() / $doctrineCriteria->getMaxResults() + 1) : 1,
            $doctrineCriteria->getMaxResults(),
            count($paginator)
        );
    }
}
