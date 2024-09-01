<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity;

use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Repository;

interface UserRepository extends Repository
{
    /**
     * @param string $username
     *
     * @return User|null
     */
    public function findByUsername(string $username): ?User;

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param Id $roleId
     * 
     * @return int
     */
    public function countByRoleId(Id $roleId): int;
}
