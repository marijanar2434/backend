<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change;

use App\Common\Domain\Repository;

interface ChangeRepository extends Repository
{
    public function findByChange(string $change): ?Change;
}
