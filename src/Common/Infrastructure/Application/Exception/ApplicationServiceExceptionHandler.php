<?php

namespace App\Common\Infrastructure\Application\Exception;

use Throwable;
use Assert\InvalidArgumentException;
use App\Common\Domain\DomainException;
use App\Common\Application\Exception\ExceptionHandler;
use App\Common\Application\Exception\ApplicationServiceException;

class ApplicationServiceExceptionHandler implements ExceptionHandler
{
    /**
     * @inheritDoc
     */
    public function handle(Throwable $e): void
    {
        if ($e instanceof ApplicationServiceException) {
            throw $e;
        }

        if ($e instanceof DomainException) {
            throw ApplicationServiceException::fromDomainException($e);
        }

        if ($e instanceof InvalidArgumentException) {
            throw ApplicationServiceException::fromInvalidArgumentException($e);
        }

        throw $e;
    }
}
