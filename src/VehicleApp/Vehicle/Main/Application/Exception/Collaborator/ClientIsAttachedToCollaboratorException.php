<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class ClientIsAttachedToCollaboratorException  extends ApplicationServiceException
{
    /**
     * RoleIsAttachedToUserException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'client.is.attached.to.collaborators', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
