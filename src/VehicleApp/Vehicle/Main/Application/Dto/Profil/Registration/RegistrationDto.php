<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Registration;

use DateTimeImmutable;
use App\Common\Application\Dto\Dto;

class RegistrationDto extends Dto
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
     * @var DateTimeImmutable
     */
    private $registrationStartDate;


    /**
     * 
     *
     * @var integer
     */
    private  int $registrationFee;


    /**
     * 
     *
     * @var string
     */
    private $user;


    /**
     * 
     *
     * @var integer
     */
    private $timeOfuser;

    /**
     * 
     *
     * @var string
     */
    private $registrationNumber;

    /**
     * 
     *
     * @var string
     */
    private $vehicle;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private $registrationExpire;

    /**
     * 
     *
     * @var array
     */
    private $documentations;

    public function __construct(
        $id,
        $registrationStartDate,
        $registrationFee,
        $user,
        $vehicle,
        $timeOfUser,
        $registrationExpire,
        $registrationNumber,
        $documentations
    ) {
        $this->id = $id;
        $this->registrationStartDate = $registrationStartDate;
        $this->registrationFee = $registrationFee;
        $this->user = $user;
        $this->vehicle = $vehicle;
        $this->timeOfuser = $timeOfUser;
        $this->registrationExpire = $registrationExpire;
        $this->registrationNumber = $registrationNumber;
        $this->documentations = $documentations;
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
     * Get the value of user
     *
     * @return  string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  string  $user
     *
     * @return  self
     */
    public function setUser(string $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of registrationNumber
     *
     * @return  string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set the value of registrationNumber
     *
     * @param  string  $registrationNumber
     *
     * @return  self
     */
    public function setRegistrationNumber(string $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
        return $this;
    }

    /**
     * Get the value of vehicle
     *
     * @return  string
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set the value of vehicle
     *
     * @param  string  $vehicle
     *
     * @return  self
     */
    public function setVehicle(string $vehicle)
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * Get the value of registrationFee
     *
     * @return  integer
     */
    public function getRegistrationFee()
    {
        return $this->registrationFee;
    }

    /**
     * Set the value of registrationFee
     *
     * @param  integer  $registrationFee
     *
     * @return  self
     */
    public function setRegistrationFee($registrationFee)
    {
        $this->registrationFee = $registrationFee;
        return $this;
    }

    /**
     * Get the value of registrationStartDate
     *
     * @return  DateTimeImmutable
     */
    public function getRegistrationStartDate()
    {
        return $this->registrationStartDate;
    }

    /**
     * Set the value of registrationStartDate
     *
     * @param  DateTimeImmutable  $registrationStartDate
     *
     * @return  self
     */
    public function setRegistrationStartDate(DateTimeImmutable $registrationStartDate)
    {
        $this->registrationStartDate = $registrationStartDate;
        return $this;
    }

    /**
     * Get the value of registrationExpire
     *
     * @return  DateTimeImmutable
     */
    public function getRegistrationExpire()
    {
        return $this->registrationExpire;
    }

    /**
     * Set the value of registrationExpire
     *
     * @param  DateTimeImmutable  $registrationExpire
     *
     * @return  self
     */
    public function setRegistrationExpire(DateTimeImmutable $registrationExpire)
    {
        $this->registrationExpire = $registrationExpire;
        return $this;
    }

    /**
     * Get the value of timeOfuser
     *
     * @return  integer
     */
    public function getTimeOfuser()
    {
        return $this->timeOfuser;
    }

    /**
     * Set the value of timeOfuser
     *
     * @param  integer  $timeOfuser
     *
     * @return  self
     */
    public function setTimeOfuser($timeOfuser)
    {
        $this->timeOfuser = $timeOfuser;
        return $this;
    }

    /**
     * Get the value of documentations
     *
     * @return  array
     */ 
    public function getDocumentations()
    {
        return $this->documentations;
    }

    /**
     * Set the value of documentations
     *
     * @param  array  $documentations
     *
     * @return  self
     */ 
    public function setDocumentations(array $documentations)
    {
        $this->documentations = $documentations;
        return $this;
    }
}
