<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Persistence\Doctrine\Auth;

use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\Client;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\ClientRepository;
use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineClientRepository extends DoctrineRepository implements ClientRepository
{
    /**
     * @inheritDoc
     */
    public function findByGeneralPurposeAuthentication(): ?Client
    {
        return $this
            ->createQueryBuilder('c')
            ->select('c')
            ->where('c.usedForGeneralPurposeAuthentication = true')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
