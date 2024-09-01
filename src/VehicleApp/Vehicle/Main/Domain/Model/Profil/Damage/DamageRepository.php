<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage;

use App\Common\Domain\Repository;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface DamageRepository extends Repository
{
    public function findByName(string $name): ?Damage;

    public function VehicleDamageGet(Id $vehicleId, Criteria $criteria): RepositoryQueryResult;

    public function countByCoverageDamageId(Id $damageCoverageId): int;

    public function countByParAndServiceId(Id $partAndServiceId): int;
}
