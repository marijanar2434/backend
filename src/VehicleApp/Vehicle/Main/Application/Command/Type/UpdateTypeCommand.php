<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Type;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UpdateTypeCommand extends Command implements TransactionalCommand, RequiresAuthorization
{

    /**
     * 
     *
     * @var string
     */
    private $id;

    /**
     * 
     *
     * @var string
     */
    private $name;


    /**
     * 
     *
     * @var string
     */
    private $brandId;

    public function __construct($id, $name,$brandId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brandId = $brandId;
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
     * Set the value of id
     *
     * @param  string  $id
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Set the value of brandId
     *
     * @param  string  $brandId
     *
     * @return  self
     */ 
    public function setBrandId(string $brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }
}

