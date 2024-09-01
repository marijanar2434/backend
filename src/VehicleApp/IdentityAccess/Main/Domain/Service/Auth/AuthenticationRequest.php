<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth;

class AuthenticationRequest
{
    /**
     * @var string
     */
    private $identity;

    /**
     * @var string
     */
    private $password;

    /**
     * AuthenticationRequest Constructor
     *
     * @param string $identity
     * @param string $password
     */
    public function __construct(string $identity, string $password)
    {
        $this->identity = $identity;
        $this->password = $password;
    }

    /**
     * @return  string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @return  string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
