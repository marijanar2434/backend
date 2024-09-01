<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class FileNotFoundException extends ApplicationServiceException
{
    /**
     *  Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'file.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}