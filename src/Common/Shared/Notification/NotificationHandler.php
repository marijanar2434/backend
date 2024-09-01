<?php

namespace App\Common\Shared\Notification;

class NotificationHandler
{
    /**
     * @var Notification[]
     */
    protected $notifications = [];

    /**
     * @param string $template
     * @param array $parameters
     * @param string $propertyPath
     * 
     * @return self
     */
    public function addNotification(string $template, array $parameters = [], string $propertyPath = null): self
    {
        $this->notifications[] = new Notification($template, $parameters, $propertyPath);

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasNotifications(): bool
    {
        return count($this->notifications) > 0;
    }

    /**
     * @return Notification[]
     */
    public function getNotifications(): array
    {
        return $this->notifications;
    }

    /**
     * @return Notification|null
     */
    public function getFirstNotification(): ?Notification
    {
        return $this->notifications[0] ?? null;
    }
}
