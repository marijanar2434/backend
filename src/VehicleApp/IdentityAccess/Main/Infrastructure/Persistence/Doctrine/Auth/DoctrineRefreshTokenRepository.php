<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\RefreshToken;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\RefreshTokenRepository;

class DoctrineRefreshTokenRepository extends DoctrineRepository implements RefreshTokenRepository
{
    /**
     * @inheritDoc
     */
    public function findByIdentifier(Id $id): ?RefreshToken
    {
        return $this
            ->createQueryBuilder('rt')
            ->select('rt')
            ->where('rt.identifier = :identifier')
            ->setParameter('identifier', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
