<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\HistoryOfChange;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChange;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChangeRepository;

class DoctrineHistoryOfChangeRepository extends DoctrineRepository implements HistoryOfChangeRepository
{ 

    public function findByName(string $name): ?HistoryOfChange
    {
        return $this->findOneBy(['fullname' => $name]);
    }
}
