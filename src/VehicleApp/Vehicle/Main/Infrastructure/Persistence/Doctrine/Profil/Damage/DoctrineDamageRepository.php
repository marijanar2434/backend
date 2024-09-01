<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Damage;

use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;

class DoctrineDamageRepository extends DoctrineRepository implements DamageRepository
{

    public function findByName(string $name): ?Damage
    {
        return $this->findOneBy(['name' => $name]);
    }


    public function VehicleDamageGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult
    {

        $doctrineCriteria = $this->criteriaBuilder->build($criteria);
        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->select('r')
            ->innerJoin('r.vehicle', 'u')
            ->where('u.id = :vehicleId')
            ->setParameter('vehicleId', $vehicleId)
            ->addCriteria($doctrineCriteria);


        $paginator = new Paginator($queryBuilder);

        return new RepositoryQueryResult(
            iterator_to_array($paginator),
            $doctrineCriteria->getFirstResult() > 0 ? ceil($doctrineCriteria->getFirstResult() / $doctrineCriteria->getMaxResults() + 1) : 1,
            $doctrineCriteria->getMaxResults(),
            count($paginator)
        );
    }

    public function countByCoverageDamageId(Id $damageCoverageId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(d.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage d JOIN d.damageCoverage dc WHERE dc.id = :damageCoverageId')
            ->setParameter('damageCoverageId', $damageCoverageId)
            ->getSingleScalarResult();
    }

    public function countByParAndServiceId(Id $partAndServiceId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(d.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage d JOIN d.partAndServices ps WHERE ps.id = :partAndServiceId')
            ->setParameter('partAndServiceId', $partAndServiceId)
            ->getSingleScalarResult();
    }
}
