<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseType;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class ExpIsAttachedToFuelAndExpenseException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'expense.type.is.attached.to.fuel.and.expense', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}