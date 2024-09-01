<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class FuelAndExpenseCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}

