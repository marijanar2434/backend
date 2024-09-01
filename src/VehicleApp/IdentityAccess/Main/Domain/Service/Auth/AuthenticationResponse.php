<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth;

class AuthenticationResponse
{
    /**
     * @var boolean
     */
    private $success;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $data;

    /**
     * AuthenticationResponse Constructor
     *
     * @param bool $success
     * @param string $message
     * @param array $data
     */
    public function __construct(bool $success, string $message, ?array $data = null)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return boolean
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return  string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return  array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
