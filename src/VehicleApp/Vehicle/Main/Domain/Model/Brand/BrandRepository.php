<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Brand;

use App\Common\Domain\Repository;

interface BrandRepository extends Repository
{
    public function findByName(string $name): ?Brand;

}
