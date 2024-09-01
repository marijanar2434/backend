<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Registration;

use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrineRegistrationRepository extends DoctrineRepository implements RegistrationRepository
{

    public function findByName(string $name): ?Registration
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByRegNumber(string $regnumber): ?array
    {
        return $this->findBy(['registrationNumber' => $regnumber, 'active' => 1]);
    }

    public function findByVehicleId(Id $id): ?array
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration r JOIN r.vehicle v WHERE v.id = :id AND r.active = 1')
            ->setParameter('id', $id)
            ->getResult();
    }


    /**
     * @inheritDoc
     */
    public function VehicleRegistrationsGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult
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
}
