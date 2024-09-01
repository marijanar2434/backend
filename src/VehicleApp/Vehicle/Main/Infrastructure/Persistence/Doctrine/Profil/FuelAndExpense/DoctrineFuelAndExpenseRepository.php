<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\FuelAndExpense;

use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrineFuelAndExpenseRepository extends DoctrineRepository implements FuelAndExpenseRepository
{

    public function findByName(string $name): ?FuelAndExpense
    {
        return $this->findOneBy(['name' => $name]);
    }


    public function VehicleFuelAndExpenseGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult
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

    public function countByExpenseTypeId(Id $expenseTypeId): int{
        return $this->getEntityManager()
            ->createQuery('SELECT count(fe.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense fe JOIN fe.expenseType et WHERE et.id = :expenseTypeId')
            ->setParameter('expenseTypeId', $expenseTypeId)
            ->getSingleScalarResult();
    }
}
