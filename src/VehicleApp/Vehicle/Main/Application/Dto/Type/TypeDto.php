<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Type;

use App\Common\Application\Dto\Dto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;

class TypeDto extends Dto
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
    private  $brand;

    /**
     * @var string
     */
    private $createdOn;

    /**
     * @var string
     */
    private $updatedOn;

    public function __construct($id,$name,string $brand,$createdOn,$updatedOn)
    {

        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
       
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
     * Get the value of createdOn
     *
     * @return  string
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set the value of createdOn
     *
     * @param  string  $createdOn
     *
     * @return  self
     */ 
    public function setCreatedOn(string $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get the value of updatedOn
     *
     * @return  string
     */ 
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set the value of updatedOn
     *
     * @param  string  $updatedOn
     *
     * @return  self
     */ 
    public function setUpdatedOn(string $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }
}
