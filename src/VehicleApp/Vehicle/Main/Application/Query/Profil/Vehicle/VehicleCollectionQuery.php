<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class VehicleCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

