<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\UserVehicle;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UserVehicleCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
