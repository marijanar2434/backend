<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Access;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class SystemRoleCannotBeModifiedException extends ApplicationServiceException
{
    /**
     * SystemRoleCannotBeModifiedException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'system.role.cannot.be.modified', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
