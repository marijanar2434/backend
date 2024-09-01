<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use Doctrine\Common\Collections\ArrayCollection;

class Company extends Entity
{

    /**
     * 
     *
     * @var string
     */
    private  $name;


    /**
     * 
     *
     * @var string
     */
    private $companyCode;

    public function __construct(Id $id, string $name, string $companyCode)
    {
        parent::__construct($id);

        $this->setName($name);
        $this->setCompanyCode($companyCode);
    }


    public function updateProperties(string $name, string $companyCode)
    {
    
        $this->setName($name);
        $this->setCompanyCode($companyCode);
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
