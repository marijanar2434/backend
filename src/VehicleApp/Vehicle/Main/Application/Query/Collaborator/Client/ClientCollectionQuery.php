<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\Client;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class ClientCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}