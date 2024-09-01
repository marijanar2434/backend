<?php

namespace App\Common\Application\Exception;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Application\Exception\ApplicationServiceException;

class ValidationServiceException extends ApplicationServiceException
{
    /**
     * @param ValidationNotificationHandler $validationNotificationHandler
     *
     * @return self
     */
    public static function fromValidationNotificationHandler(ValidationNotificationHandler $validationNotificationHandler): self
    {
        $self = new self(
            'validation.error'
        );

        foreach ($validationNotificationHandler->getNotifications() as $notification) {
            $self->addError($notification->getTemplate(), $notification->getParameters(), $notification->getPropertyPath());
        }
    

        return $self;
    }
}
