<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Access;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class SystemRoleCannotBeDeletedException extends ApplicationServiceException
{
    /**
     * SystemRoleCannotBeDeletedException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'system.role.cannot.be.deleted', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
