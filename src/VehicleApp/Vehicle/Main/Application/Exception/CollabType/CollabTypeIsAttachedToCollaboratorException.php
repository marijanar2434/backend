<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\CollabType;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class CollabTypeIsAttachedToCollaboratorException extends ApplicationServiceException
{
    /**
     * RoleIsAttachedToUserException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'collaborator.type.is.attached.to.collaborator', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
