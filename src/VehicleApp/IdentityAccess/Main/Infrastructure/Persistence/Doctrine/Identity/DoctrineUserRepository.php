<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Identity;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\UserRepository;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    /**
     * @inheritDoc
     */
    public function findByUsername(string $username): ?User
    {
        return $this->findOneBy(['username' => $username]);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @inheritDoc
     */
    public function countByRoleId(Id $roleId): int
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(u.id) FROM App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User u JOIN u.roles r WHERE r.id = :roleId')
            ->setParameter('roleId', $roleId)
            ->getSingleScalarResult();
    }
}
