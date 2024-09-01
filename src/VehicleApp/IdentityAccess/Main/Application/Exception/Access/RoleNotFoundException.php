<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Access;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class RoleNotFoundException extends ApplicationServiceException
{
    /**
     * RoleNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'role.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
