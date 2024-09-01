<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Damage;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DamageCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}