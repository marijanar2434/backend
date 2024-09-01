<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Type;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;

interface TypeRepository extends Repository
{
    public function findByName(string $name): ?Type;

    public function countByBrandId(Id $brandId): int;
}
