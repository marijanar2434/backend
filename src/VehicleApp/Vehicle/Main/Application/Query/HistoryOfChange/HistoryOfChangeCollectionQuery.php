<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\HistoryOfChange;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class HistoryOfChangeCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

