<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Client;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateClientCommand extends Command implements TransactionalCommand
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
    private  $fullname;

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



    public function __construct($id, $fullname, $adress, $phoneNumber, $email, $website)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->address = $adress;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email; 
        $this->website = $website;
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
     * Get the value of fullname
     *
     * @return  string
     */
    public function getFullname()
    {
        return $this->fullname;
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
     * Get the value of phoneNumber
     *
     * @return  string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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
     * Get the value of website
     *
     * @return  string
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
