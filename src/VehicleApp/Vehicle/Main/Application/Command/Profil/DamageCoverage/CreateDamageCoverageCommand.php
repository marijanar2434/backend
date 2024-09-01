<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateDamageCoverageCommand extends Command implements TransactionalCommand
{

    /**
     * 
     *
     * @var string
     */
    private  $id;


    /**
     * 
     *
     * @var string
     */
    private  $name;


    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }
}



