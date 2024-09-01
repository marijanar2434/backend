<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange;

use App\Common\Domain\Repository;

interface HistoryOfChangeRepository extends Repository
{
    public function findByName(string $change): ?HistoryOfChange;
}
