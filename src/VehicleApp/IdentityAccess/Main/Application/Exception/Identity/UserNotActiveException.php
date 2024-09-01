<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class UserNotActiveException extends ApplicationServiceException
{
    /**
     * UserNotActiveException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'user.not.active', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
