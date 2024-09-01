<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth;

use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\AccessToken;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\AccessTokenRepository;

class DoctrineAccessTokenRepository extends DoctrineRepository implements AccessTokenRepository
{
    /**
     * @inheritDoc
     */
    public function findByIdentifier(Id $id): ?AccessToken
    {
        return $this
            ->createQueryBuilder('at')
            ->select('at')
            ->where('at.identifier = :identifier')
            ->setParameter('identifier', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
