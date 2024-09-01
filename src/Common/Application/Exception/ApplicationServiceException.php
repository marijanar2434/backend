<?php

namespace App\Common\Application\Exception;

use Exception;
use Throwable;
use App\Common\Shared\C;
use Assert\InvalidArgumentException;
use App\Common\Domain\DomainException;
use App\Common\Shared\Notification\Notification;
use App\Common\Shared\Notification\NotificationHandler;

class ApplicationServiceException extends Exception
{
    /**
     * @var NotificationHandler
     */
    protected $notificationHandler;

    /**
     * ApplicationServiceException Constructor
     *
     * @param string $message
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->notificationHandler = new NotificationHandler();
    }

    /**
     * @param string $template
     * @param array $parameters
     * @param string|null $propertyPath
     * 
     * @return void
     */
    public function addError(string $template, array $parameters = [], ?string $propertyPath = null): void
    {
        $this->notificationHandler->addNotification($template, $parameters, $propertyPath);
    }

    /**
     * @return Notification[]
     */
    public function getErrors(): array
    {
        return $this->notificationHandler->getNotifications();
    }

    /**
     * @return boolean
     */
    public function hasErrors(): bool
    {
        return $this->notificationHandler->hasNotifications();
    }

    /**
     * @param DomainException $e
     * 
     * @return self
     */
    public static function fromDomainException(DomainException $e): self
    {
        $self = new self(
            C::CamelCaseToDot(C::className($e))
        );

        return $self;
    }

    /**
     * @param InvalidArgumentException $e
     * 
     * @return self
     */
    public static function fromInvalidArgumentException(InvalidArgumentException $e): self
    {
        $self = new self(
            $e->getMessage()
        );

        $self->addError($e->getMessage(), [], $e->getPropertyPath());

        return $self;
    }
}
