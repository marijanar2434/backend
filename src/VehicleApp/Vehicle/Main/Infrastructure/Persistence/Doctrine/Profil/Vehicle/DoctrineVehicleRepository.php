<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\Vehicle;

use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class DoctrineVehicleRepository extends DoctrineRepository implements VehicleRepository
{

    public function findByName(string $name): ?Vehicle
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByChassis(string $chassis): ?Vehicle
    {
        return $this->findOneBy(['chassisNumber' => $chassis]);
    }

    public function countByTypeId(Id $typeId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle u JOIN u.type t WHERE t.id = :typeId')
            ->setParameter('typeId', $typeId)
            ->getSingleScalarResult();
    }

    public function countByColorId(Id $colorId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle u JOIN u.color c WHERE c.id = :colorId')
            ->setParameter('colorId', $colorId)
            ->getSingleScalarResult();
    }
}
