<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyUserCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $id;

    /**
     * DestroyUserCommand Constructor
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
