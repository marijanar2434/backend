<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class VehicleNotFoundException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'vehicle.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}