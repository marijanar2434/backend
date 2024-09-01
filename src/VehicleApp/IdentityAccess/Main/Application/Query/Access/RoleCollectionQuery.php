<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Access;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class RoleCollectionQuery extends CollectionQuery implements RequiresAuthorization
{
}
