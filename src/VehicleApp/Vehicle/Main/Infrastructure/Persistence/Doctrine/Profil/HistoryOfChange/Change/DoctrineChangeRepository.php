<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Profil\HistoryOfChange\Change;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change\Change;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change\ChangeRepository;

class DoctrineChangeRepository extends DoctrineRepository implements ChangeRepository
{

    public function findByChange(string $change): ?Change
    {
        return $this->findOneBy(['change' => $change]);
    }
}
