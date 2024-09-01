<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Maintenance;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class MaintenanceCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

