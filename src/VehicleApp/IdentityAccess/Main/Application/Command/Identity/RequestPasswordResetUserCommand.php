<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class RequestPasswordResetUserCommand extends Command implements TransactionalCommand
{
    /**
     * @var string
     */
    private $email;

    /**
     * RequestPasswordResetUserCommand Constructor
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return  string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
