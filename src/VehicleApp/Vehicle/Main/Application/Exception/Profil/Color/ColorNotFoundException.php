<?php
namespace App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color;

use App\Common\Application\Exception\ApplicationServiceException;
use Throwable;

class ColorNotFoundException extends ApplicationServiceException
{
    /**
     * BrandNotFoundException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message = 'color.not.found', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}