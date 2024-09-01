<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyRoleCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $id;

    /**
     * DestroyRoleCommand Constructor
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
