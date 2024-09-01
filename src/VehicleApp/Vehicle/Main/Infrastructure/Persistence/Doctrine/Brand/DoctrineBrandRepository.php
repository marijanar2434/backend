<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Brand;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;

class DoctrineBrandRepository extends DoctrineRepository implements BrandRepository
{

    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?Brand
    {
        return $this->findOneBy(['name' => $name]);
    }
}
