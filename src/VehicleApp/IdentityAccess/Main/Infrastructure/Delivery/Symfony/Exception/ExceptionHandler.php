<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception;

use Throwable;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Application\Exception\ApplicationServiceException;
use App\Common\Infrastructure\Delivery\Symfony\Exception\HttpException;
use App\Common\Application\Exception\ExceptionHandler as IExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Auth\UserAuthFailedException;
use App\Common\Infrastructure\Delivery\Symfony\Bus\Exception\UnauthorizedExecutionException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Access\RoleIsAttachedToUserException;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserDidNotRequestedPasswordResetException;

class ExceptionHandler implements IExceptionHandler
{
    /**
     * @inheritDoc
     */
    public function handle(Throwable $e): void
    {
        if ($e instanceof UserNotFoundException || $e instanceof RoleNotFoundException) {
            throw HttpException::fromApplicationServiceException($e, 'IdentityAccess', 404);
        }

        if ($e instanceof ValidationServiceException || $e instanceof UserAuthFailedException || $e instanceof RoleIsAttachedToUserException || $e instanceof UserDidNotRequestedPasswordResetException) {
            throw HttpException::fromApplicationServiceException($e, 'IdentityAccess', 400);
        }

        if ($e instanceof UnauthorizedExecutionException) {
            throw HttpException::fromUnathorizedExecutionException($e, 'IdentityAccess');
        }

        if ($e instanceof ApplicationServiceException) {
            throw HttpException::fromApplicationServiceException($e, 'IdentityAccess', 400);
        }

        throw $e;
    }
}
