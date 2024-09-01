<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Type;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class TypeIsAttachedToVehicleException extends ApplicationServiceException
{
    /**
     * RoleIsAttachedToUserException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'type.is.attached.to.vehicle', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

