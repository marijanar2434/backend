<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Color;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyColorCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * 
     *
     * @var string
     */
    private $id;


    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * Get the value of id
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
