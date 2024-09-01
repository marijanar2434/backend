<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Exception;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Common\Application\Exception\ValidationServiceException;
use App\Common\Application\Exception\ApplicationServiceException;
use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException as BaseHttpException;
use App\Common\Infrastructure\Delivery\Symfony\Bus\Exception\UnauthorizedExecutionException;

class HttpException extends BaseHttpException
{
    /**
     * @param ApplicationServiceException $exception
     * @param int $statusCode
     *
     * @return self|ValidationException
     */
    public static function fromApplicationServiceException(ApplicationServiceException $exception, string $translationDomain = 'Common', $statusCode = 500): self|ValidationException
    {
        if ($exception instanceof ValidationServiceException) {
            return self::toValidationHttpException($exception, $translationDomain);
        }

        return new self($statusCode, $exception->getMessage(), $exception, [], $exception->getCode());
    }

    /**
     * @param UnauthorizedExecutionException $exception
     * 
     * @return self
     */
    public static function fromUnathorizedExecutionException(UnauthorizedExecutionException $exception, string $translationDomain = 'Common'): self
    {
        return new self(401, $exception->getMessage(), $exception, [], $exception->getCode());
    }

    /**
     * @param ApplicationServiceException $exception
     * 
     * @return ValidationException
     */
    public static function toValidationHttpException(ApplicationServiceException $exception, string $translationDomain = 'Common'): ValidationException
    {
        $constraintValidationList = new ConstraintViolationList();
        foreach ($exception->getErrors() as $error) {
            $constraintValidationList->add(
                new ConstraintViolation(
                    $error->getNotification(),
                    $error->getTemplate(),
                    $error->getParameters(),
                    null,
                    $error->getPropertyPath(),
                    null
                )
            );
        }

        return new ValidationException($constraintValidationList, $exception->getMessage(), $exception->getCode(), $exception);
    }
}
