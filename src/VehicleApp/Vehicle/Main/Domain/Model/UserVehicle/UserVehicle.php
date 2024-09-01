<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;

class UserVehicle extends Entity
{

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
    private $username;


    /**
     * 
     *
     * @var string
     */
    private $email;

    public function __construct(
        Id $id,
        string $fullname,
        string $username,
        string $email
    ) {
        parent::__construct($id);

        $this->setFullname($fullname);
        $this->setUsername($username);
        $this->setEmail($email);
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
     * Get the value of username
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
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
}
