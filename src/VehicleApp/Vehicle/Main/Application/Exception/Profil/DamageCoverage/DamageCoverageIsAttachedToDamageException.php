<?php

namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class DamageCoverageIsAttachedToDamageException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'damage.coverage.is.attached.to.damage', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
