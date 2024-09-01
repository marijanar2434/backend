<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\PartAndService;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class PartAndServiceCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
