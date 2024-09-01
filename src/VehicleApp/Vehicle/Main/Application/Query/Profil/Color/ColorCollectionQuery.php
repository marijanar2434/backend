<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Color;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class ColorCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

