<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Brand;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateBrandCommand extends Command implements TransactionalCommand
{
    /**
     * @var string
     */
    private $name;


    /**
     * 
     *
     * @var string
     */
    private  $id;

    /**
     * 
     *
     * @param string $id
     * @param string $name
     */
    public function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * 
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 
     * @return  string
     */ 
    public function getId(): string
    {
        return $this->id;
    }
}
