<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\Company;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CompanyCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
