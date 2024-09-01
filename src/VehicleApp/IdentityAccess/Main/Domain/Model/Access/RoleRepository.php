<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Access;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\RepositoryQueryResult;
use App\Common\Infrastructure\Persistence\Query\Criteria;

interface RoleRepository extends Repository
{
    /**
     * @param string $identifier
     *
     * @return Role|null
     */
    public function findByIdentifier(string $identifier): ?Role;

    /**
     * @param string $name
     *
     * @return Role|null
     */
    public function findByName(string $name): ?Role;

    /**
     * @param Id $userId
     * @param Criteria $criteria
     * 
     * @return RepositoryQueryResult
     */
    public function queryAttachedToUser(Id $userId, Criteria $criteria): RepositoryQueryResult;

    /**
     * @param Id $userId
     * @param Criteria $criteria
     * 
     * @return RepositoryQueryResult
     */
    public function queryNotAttachedToUser(Id $userId, Criteria $criteria): RepositoryQueryResult;
}
