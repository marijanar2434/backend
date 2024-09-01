<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\UserVehicle;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateUserVehicleCommand extends Command implements TransactionalCommand
{

    /**
     * 
     *
     * @var string
     */
    private  $id;

    /**
     * @var string
     */
    private $fullname;


    public function __construct($id, $fullname)
    {
        $this->id = $id;
        $this->fullname = $fullname;
    }


    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * 
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
