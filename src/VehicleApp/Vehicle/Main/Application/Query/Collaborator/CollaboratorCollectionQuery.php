<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CollaboratorCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

