<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class UserNotFoundException extends ApplicationServiceException
{
    /**
     * UserNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'user.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
