<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class SendPasswordResetEmailToUserCommand extends Command implements TransactionalCommand
{
    /**
     * @var string
     */
    private $userId;

    /**
     * SendPasswordResetEmailToUserCommand Constructor
     *
     * @param string $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return  string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
