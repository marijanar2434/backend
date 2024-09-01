<?php

namespace App\Common\Shared\Notification;

class Notification
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var string|null
     */
    protected $propertyPath;

    /**
     * Notification constructor
     * 
     * @param string $template
     * @param array $parameters
     * @param string|null $propertyPath
     */
    public function __construct(string $template, array $parameters = [], ?string $propertyPath = null)
    {
        $this->template = $template;
        $this->parameters = $parameters;
        $this->propertyPath = $propertyPath;
    }

    /**
     * @return string
     */
    public function getNotification(): string
    {
        return \strtr(
            $this->template,
            \array_map(fn ($v) => trim($v), $this->getParameters())
        );
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string|null
     */
    public function getPropertyPath(): ?string
    {
        return $this->propertyPath;
    }

    /**
     * @return boolean
     */
    public function hasPropertyPath(): bool
    {
        return !empty($this->propertyPath);
    }
}
