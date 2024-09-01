<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Damage;

use DateTimeImmutable;
use App\Common\Application\Dto\Dto;

class DamageDto extends Dto
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
    private  $description;


    /**
     * 
     *
     * @var string
     */
    private  $damageCoverage;


    /**
     * 
     *
     * @var array
     */
    private $partAndServices;



   /**
    * 
    *
    * @var float
    */
    private $fee;



    /**
     * 
     *
     * @var string|null
     */
    private  $user;



    /**
     * 
     *
     * @var integer|null
     */
    private  $timeOfUser;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private  $date;

    public function __construct(
        $id,
        $description,
        $damageCoverage,
        $date,
        $fee,
        $user,
        $timeOfUser,
        $partAndServices
    ) {

        $this->id = $id;
        $this->description = $description;
        $this->damageCoverage = $damageCoverage;
        $this->date = $date;
        $this->fee = $fee;
        $this->user = $user;
        $this->timeOfUser = $timeOfUser;
        $this->partAndServices = $partAndServices;
    }



    /**
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

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
     *
     * @return  float
     */ 
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set the value of fee
     *
     * @param  float  $fee
     *
     * @return  self
     */ 
    public function setFee(float $fee)
    {
        $this->fee = $fee;
        return $this;
    }

    /**
     * Get the value of damageCoverage
     *
     * @return  string
     */ 
    public function getDamageCoverage()
    {
        return $this->damageCoverage;
    }

    /**
     * Set the value of damageCoverage
     *
     * @param  string  $damageCoverage
     *
     * @return  self
     */ 
    public function setDamageCoverage(string $damageCoverage)
    {
        $this->damageCoverage = $damageCoverage;
        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  string|null
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  string|null  $user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
