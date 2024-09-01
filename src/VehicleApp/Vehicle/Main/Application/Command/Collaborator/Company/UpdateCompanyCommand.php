<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Company;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class UpdateCompanyCommand extends Command implements TransactionalCommand
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


    private $companyCode;

    public function __construct($id, $name, $companyCode)
    {

        $this->id  = $id;
        $this->name = $name;
        $this->companyCode = $companyCode;
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
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of companyCode
     */ 
    public function getCompanyCode()
    {
        return $this->companyCode;
    }

    /**
     * Set the value of companyCode
     *
     * @return  self
     */ 
    public function setCompanyCode($companyCode)
    {
        $this->companyCode = $companyCode;
        return $this;
    }
}
