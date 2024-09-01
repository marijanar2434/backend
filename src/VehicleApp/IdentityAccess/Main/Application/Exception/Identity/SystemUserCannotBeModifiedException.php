<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity;

use Throwable;
use App\Common\Application\Exception\ApplicationServiceException;

class SystemUserCannotBeModifiedException extends ApplicationServiceException
{
    /**
     * SystemUserCannotBeModifiedException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'system.user.cannot.be.modified', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
