<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception;

use Throwable;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Application\Exception\ApplicationServiceException;
use App\Common\Infrastructure\Delivery\Symfony\Exception\HttpException;
use App\Common\Application\Exception\ExceptionHandler as IExceptionHandler;
use App\Common\Infrastructure\Delivery\Symfony\Bus\Exception\UnauthorizedExecutionException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandIsAttachedToTypesException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Brand\BrandNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorIsAttachedToVehiclesException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Color\ColorNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Registration\RegistrationNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Type\TypeNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;

class ExceptionHandler implements IExceptionHandler
{
    /**
     * @inheritDoc
     */
    public function handle(Throwable $e): void
    {
        if ($e instanceof BrandNotFoundException || $e instanceof  TypeNotFoundException || $e instanceof  VehicleNotFoundException 
        || $e instanceof  ColorNotFoundException || $e instanceof UserNotFoundException || $e instanceof RegistrationNotFoundException) {
            throw HttpException::fromApplicationServiceException($e, 'Vehicle', 404);
        }
        if ($e instanceof ValidationServiceException || $e instanceof BrandIsAttachedToTypesException || $e instanceof ColorIsAttachedToVehiclesException) {
            throw HttpException::fromApplicationServiceException($e, 'Vehicle', 400);
        }

        if ($e instanceof UnauthorizedExecutionException) {
            throw HttpException::fromUnathorizedExecutionException($e, 'Vehicle');
        }

        if ($e instanceof ApplicationServiceException) {
            throw HttpException::fromApplicationServiceException($e, 'Vehicle', 400);
        }

        throw $e;
    }
}