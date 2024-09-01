<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company;

use App\Common\Domain\Repository;

interface CompanyRepository extends Repository
{
    public function findByName(string $name): ?Company;
}


