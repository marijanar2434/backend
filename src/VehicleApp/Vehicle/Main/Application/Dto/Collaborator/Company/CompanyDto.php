<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Company;

use App\Common\Application\Dto\Dto;

class CompanyDto extends Dto
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
    private  $companyCode;

    public function __construct($id, $name, $companyCode)
    {
        $this->id = $id;
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
     * Get the value of companyCode
     *
     * @return  string
     */ 
    public function getCompanyCode()
    {
        return $this->companyCode;
    }

    /**
     * Set the value of companyCode
     *
     * @param  string  $companyCode
     *
     * @return  self
     */ 
    public function setCompanyCode(string $companyCode)
    {
        $this->companyCode = $companyCode;
        return $this;
    }
}
