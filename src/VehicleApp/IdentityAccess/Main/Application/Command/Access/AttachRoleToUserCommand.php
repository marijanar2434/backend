<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class AttachRoleToUserCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $roleId;

    /**
     * AttachRoleToUserCommand Constructor
     *
     * @param string $userId
     * @param string $roleId
     */
    public function __construct($userId, $roleId)
    {
        $this->userId = $userId;
        $this->roleId = $roleId;
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
    public function getRoleId(): string
    {
        return $this->roleId;
    }
}
