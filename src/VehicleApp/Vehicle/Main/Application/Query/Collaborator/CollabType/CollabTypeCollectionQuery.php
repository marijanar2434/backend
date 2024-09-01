<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\CollabType;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CollabTypeCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}