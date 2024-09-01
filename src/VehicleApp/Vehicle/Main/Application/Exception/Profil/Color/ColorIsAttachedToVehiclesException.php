<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class ColorIsAttachedToVehiclesException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'color.is.attached.to.vehicles', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}