<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class UserDidNotRequestedPasswordResetException extends ApplicationServiceException
{
    /**
     * UserDidNotRequestedPasswordResetException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'user.not.requested.password.reset', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
