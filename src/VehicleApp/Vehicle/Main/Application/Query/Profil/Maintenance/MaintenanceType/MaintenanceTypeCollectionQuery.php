<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class MaintenanceTypeCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
