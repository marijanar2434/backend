<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Maintenance;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class MaintenanceNotFoundException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'maintenance.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
