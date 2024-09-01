<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class SystemUserCannotBeDeletedException extends ApplicationServiceException
{
    /**
     * SystemUserCannotBeDeletedException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'system.user.cannot.be.deleted', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
