<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator;

use App\Common\Application\Dto\Dto;

class CollaboratorDto extends Dto
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
    private $companyName;


    /**
     * 
     *
     * @var string
     */
    private  $companyCode;


    /**
     * 
     *
     * @var string
     */
    private $fullname;


    /**
     * 
     *
     * @var string
     */
    private  $address;


    /**
     * 
     *
     * @var string
     */
    private  $phoneNumber;


    /**
     * 
     *
     * @var string
     */
    private  $email;


    /**
     * 
     *
     * @var string
     */
    private  $website;


      /**
     * 
     *
     * @var array
     */
    private  $types;

    public function __construct(
        $id,
        $companyName,
        $companyCode,
        $fullname,
        $address,
        $phoneNumber,
        $email,
        $website,
        $types
    ) {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->companyCode = $companyCode;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->website = $website;
        $this->types = $types;
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
     * Get the value of companyName
     *
     * @return  string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @param  string  $companyName
     *
     * @return  self
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
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

    /**
     * Get the value of fullname
     *
     * @return  string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     *
     * @param  string  $fullname
     *
     * @return  self
     */
    public function setFullname(string $fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string  $address
     *
     * @return  self
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get the value of phoneNumber
     *
     * @return  string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @param  string  $phoneNumber
     *
     * @return  self
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of website
     *
     * @return  string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the value of website
     *
     * @param  string  $website
     *
     * @return  self
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get the value of types
     *
     * @return  array
     */ 
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set the value of types
     *
     * @param  array  $types
     *
     * @return  self
     */ 
    public function setTypes(array $types)
    {
        $this->types = $types;
        return $this;
    }
}
