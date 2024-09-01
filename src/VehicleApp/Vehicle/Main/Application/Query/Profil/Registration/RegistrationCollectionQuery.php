<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Registration;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class RegistrationCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
