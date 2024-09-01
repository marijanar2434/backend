<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\PartAndService;

use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;


class DoctrinePartAndServiceRepository extends DoctrineRepository implements PartAndServiceRepository
{
    /**
     * @inheritDoc
     */
    public function findByName(string $name): ?PartAndService
    {
        return $this->findOneBy(['name' => $name]);
    }
}
