<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Identity;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UserCollectionQuery extends CollectionQuery implements RequiresAuthorization
{
}
