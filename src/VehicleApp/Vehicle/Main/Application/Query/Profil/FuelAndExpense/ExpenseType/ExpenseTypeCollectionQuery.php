<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class ExpenseTypeCollectionQuery extends CollectionQuery implements RequiresAuthorization
{ 

}
