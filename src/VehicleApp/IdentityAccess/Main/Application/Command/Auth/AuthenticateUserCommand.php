<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Auth;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class AuthenticateUserCommand extends Command implements TransactionalCommand
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
     * AuthenticateUserCommand Constructor
     *
     * @param string $identity
     * @param string $password
     */
    public function __construct($identity, $password = null)
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
