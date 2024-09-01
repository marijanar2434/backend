<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class PartAndServiceIsAttachedToDamageException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'part.and.service.is.attached.to.damage', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}