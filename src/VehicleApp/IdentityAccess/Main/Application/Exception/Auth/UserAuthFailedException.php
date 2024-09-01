<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Auth;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class UserAuthFailedException extends ApplicationServiceException
{
    /**
     * UserAuthFailedException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'user.authorization.failed', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
