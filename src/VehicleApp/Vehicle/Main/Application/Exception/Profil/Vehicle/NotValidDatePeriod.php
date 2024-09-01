<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class NotValidDatePeriod extends ApplicationServiceException
{
/**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'active.date.not.valid', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
