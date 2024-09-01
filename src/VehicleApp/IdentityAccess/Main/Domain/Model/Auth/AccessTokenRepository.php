<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;

interface AccessTokenRepository extends Repository
{
    /**
     * @param Id $id
     *
     * @return AccessToken|null
     */
    public function findByIdentifier(Id $id): ?AccessToken;
}
