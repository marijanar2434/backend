<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client\Client;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\Company;

interface CollaboratorRepository  extends Repository
{
    public function findByName(string $name): ?Collaborator;

    public function FindByClientAndCompany(Client $client, Company $company): ?Collaborator;

    public function countByClientId(Id $clientId): int;

    public function countByCollabTypetId(Id $collabTypeId): int;

    public function countByCompanytId(Id $companyId): int;
}

