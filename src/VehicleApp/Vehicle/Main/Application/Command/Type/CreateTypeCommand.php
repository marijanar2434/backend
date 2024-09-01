<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Type;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;

class CreateTypeCommand extends Command implements TransactionalCommand
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
     * @var string
     */
    private $brandId;

    public function __construct($id, $name, $brandId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brandId = $brandId;
    }


    public function getName(): string
    {
        return $this->name;
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


    /**
     * Get the value of brandId
     *
     * @return  string
     */ 
    public function getBrandId()
    {
        return $this->brandId;
    }
}
