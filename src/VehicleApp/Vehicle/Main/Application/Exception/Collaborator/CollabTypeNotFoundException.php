<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Collaborator;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class CollabTypeNotFoundException  extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'collab.type..not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}