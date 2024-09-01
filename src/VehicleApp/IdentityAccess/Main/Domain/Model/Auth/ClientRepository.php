<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use App\Common\Domain\Repository;

interface ClientRepository extends Repository
{
    /**
     * @return Client|null
     */
    public function findByGeneralPurposeAuthentication(): ?Client;
}
