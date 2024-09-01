<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class ExpenseCannotBeNegativeException  extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'expense.can.not.be.negative.or.0', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

