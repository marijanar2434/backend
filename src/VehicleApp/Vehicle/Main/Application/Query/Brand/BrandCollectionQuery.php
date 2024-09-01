<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Brand;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class BrandCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
