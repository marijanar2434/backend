<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Type;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class TypeCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
