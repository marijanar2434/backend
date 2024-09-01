<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Type;

use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;

class DoctrineTypeRepository extends DoctrineRepository implements TypeRepository
{

    public function findByName(string $name): ?Type
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function countByBrandId(Id $brandId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type u JOIN u.brand b WHERE b.id = :brandId')
            ->setParameter('brandId', $brandId)
            ->getSingleScalarResult();
    }
}
