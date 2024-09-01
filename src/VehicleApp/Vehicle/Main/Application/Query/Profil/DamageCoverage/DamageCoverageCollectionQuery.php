<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\DamageCoverage;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DamageCoverageCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}