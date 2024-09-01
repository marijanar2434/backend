<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Client;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Collaborator;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class Client extends Entity
{

    use DateTimeTracking, DomainEventRecording;

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


    public function __construct(
        Id $id,
        string $fullname,
        string $address,
        string $phoneNumber,
        string $email,
        string $website
    ) {
        parent::__construct($id);
        $this->setFullname($fullname);
        $this->setAddress($address);
        $this->setPhoneNumber($phoneNumber);
        $this->setEmail($email);
        $this->setWebsite($website);


        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
    }



    public function updateProperties(string $fullname, string $address, string $phoneNumber, string $email, string $website)
    {
        $this->setFullname($fullname);
        $this->setAddress($address);
        $this->setPhoneNumber($phoneNumber);
        $this->setEmail($email);
        $this->setWebsite($website);



        $this->setUpdatedOn(new DateTimeImmutable());
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
}
