<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance;

use DateTimeImmutable;
use App\Common\Application\Dto\Dto;

class MaintenanceDto extends Dto
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
     * @var integer
     */
    private  $mileage;

    /**
     * 
     *
     * @var float
     */
    private $fee;


    /**
     * 
     *
     * @var integer|null
     */
    private  $timeOfUser;


    /**
     * 
     *
     * @var string
     */
    private  $user;


    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private $date;


    /**
     * 
     *
     * @var string
     */
    private  $type;


    /**
     * 
     *
     * @var array
     */
    private  $partAndServices;

    public function __construct(
        $id,
         $type,
         $date,
         $mileage,
         $fee,
         $timeOfUser,
         $user,
         $partAndServices
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->date = $date;
        $this->mileage = $mileage;
        $this->fee = $fee;
        $this->timeOfUser = $timeOfUser;
        $this->user = $user;
        $this->partAndServices = $partAndServices;
    }

    /**
     * Get the value of timeOfUser
     *
     * @return  integer|null
     */
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
    }

    /**
     * Set the value of timeOfUser
     *
     * @param  integer|null  $timeOfUser
     *
     * @return  self
     */
    public function setTimeOfUser($timeOfUser)
    {
        $this->timeOfUser = $timeOfUser;
        return $this;
    }



    /**
     * Get the value of date
     *
     * @return  DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param  DateTimeImmutable  $date
     *
     * @return  self
     */
    public function setDate(DateTimeImmutable $date)
    {
        $this->date = $date;
        return $this;
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
     * Get the value of type
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;
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
     * Get the value of partAndServices
     *
     * @return  array
     */ 
    public function getPartAndServices()
    {
        return $this->partAndServices;
    }

    /**
     * Set the value of partAndServices
     *
     * @param  array  $partAndServices
     *
     * @return  self
     */ 
    public function setPartAndServices(array $partAndServices)
    {
        $this->partAndServices = $partAndServices;
        return $this;
    }

    /**
     * Get the value of fee
     */ 
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set the value of fee
     *
     * @return  self
     */ 
    public function setFee($fee)
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * Get the value of mileage
     *
     * @return  integer
     */ 
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set the value of mileage
     *
     * @param  integer  $mileage
     *
     * @return  self
     */ 
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }
}
