<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Persistence\Doctrine\Collaborator\Company;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class DoctrineCompanyRepository extends DoctrineRepository implements CompanyRepository
{

    public function findByName(string $name): ?Company
    {
        return $this->findOneBy(['name' => $name]);
    }
}