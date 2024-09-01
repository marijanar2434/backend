<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Access;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class RoleIsAttachedToUserException extends ApplicationServiceException
{
    /**
     * RoleIsAttachedToUserException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'role.is.attached.to.user', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
