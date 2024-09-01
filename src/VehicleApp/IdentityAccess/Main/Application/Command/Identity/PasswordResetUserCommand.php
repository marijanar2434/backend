<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class PasswordResetUserCommand extends Command implements TransactionalCommand
{
    /**
     * @var string
     */
    private $passwordRequestId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $password;

    /**
     * PasswordResetUserCommand Constructor
     *
     * @param string $passwordRequestId
     * @param string $userId
     * @param string $password
     */
    public function __construct($passwordRequestId, $userId, $password)
    {
        $this->passwordRequestId = $passwordRequestId;
        $this->userId = $userId;
        $this->password = $password;
    }

    /**
     * @return  string
     */
    public function getPasswordRequestId(): string
    {
        return $this->passwordRequestId;
    }

    /**
     * @return  string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return  string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
