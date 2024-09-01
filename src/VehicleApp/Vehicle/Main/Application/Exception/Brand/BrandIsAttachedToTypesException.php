<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Brand;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class BrandIsAttachedToTypesException extends ApplicationServiceException
{
    /**
     * RoleIsAttachedToUserException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'brand.is.attached.to.types', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
