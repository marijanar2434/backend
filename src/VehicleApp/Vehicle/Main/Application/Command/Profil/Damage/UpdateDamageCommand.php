<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage;

use DateTimeImmutable;
use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UpdateDamageCommand  extends Command implements TransactionalCommand, RequiresAuthorization
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
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * 
     *
     * @var integer
     */
    private $timeOfUser;

    /**
     * 
     *
     * @var float
     */
    private  $fee;

    /**
     * 
     *
     * @var string
     */
    private  $userId;


    /**
     * 
     *
     * @var string
     */
    private $damageCoverage;


    /**
     * 
     *
     * @var string
     */
    private  $vehicleId;

    public function __construct($id, $description, $date, $fee,  $userId, $timeOfUser, $damageCoverage, $vehicleId)
    {
        $this->id = $id;
        $this->description = $description;
        $this->date = $date;
        $this->fee = $fee;
        $this->userId = $userId;
        $this->timeOfUser = $timeOfUser;
        $this->damageCoverage = $damageCoverage;
        $this->vehicleId = $vehicleId;
    }




    /**
     * Get the value of timeOfUser
     *
     * @return  integer
     */
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
    }

    /**
     * Set the value of timeOfUser
     *
     * @param  integer  $timeOfUser
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
     * Get the value of userId
     *
     * @return  string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param  string  $userId
     *
     * @return  self
     */
    public function setUserId(string $userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get the value of vehicleId
     *
     * @return  string
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    /**
     * Set the value of vehicleId
     *
     * @param  string  $vehicleId
     *
     * @return  self
     */
    public function setVehicleId(string $vehicleId)
    {
        $this->vehicleId = $vehicleId;
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
}
