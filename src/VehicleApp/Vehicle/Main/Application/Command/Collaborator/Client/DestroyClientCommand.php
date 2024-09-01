<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Client;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyClientCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * 
     *
     * @var string
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of id
     *
     * @return  string
     */ 
    public function getId()
    {
        return $this->id;
    }
}

