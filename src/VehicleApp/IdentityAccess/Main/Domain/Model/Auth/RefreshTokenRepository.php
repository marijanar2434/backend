<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use App\Common\Domain\Repository;
use App\Common\Domain\ValueObject\Id;

interface RefreshTokenRepository extends Repository
{
    /**
     * @param Id $id
     *
     * @return RefreshToken|null
     */
    public function findByIdentifier(Id $id): ?RefreshToken;
}
