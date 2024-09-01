<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\Client;

use App\Common\Application\Dto\Dto;

class ClientDto extends Dto
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




    public function __construct($id, $fullname, $address, $phoneNumber, $email, $website)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->website = $website;
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
}
