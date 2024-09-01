<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;
use DateTimeImmutable;

class UpdateMaintenanceCommand  extends Command implements TransactionalCommand, RequiresAuthorization
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
     * @var DateTimeImmutable
     */
    private $date;

   /**
    * 
    *
    * @var integer
    */
    private  $timeOfUser;

    /**
     * 
     *
     * @var float
     */
    private  $fee;

    /**
     * 
     *
     * @var int
     */
    private  $mileage;

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
    private  $vehicleId;

    public function __construct($id,  $date,  $mileage, $fee,  $userId, $timeOfUser, $vehicleId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->mileage = $mileage;
        $this->fee = $fee;
        $this->userId = $userId;
        $this->timeOfUser = $timeOfUser;
        $this->vehicleId = $vehicleId;
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
     * Get the value of mileage
     *
     * @return  int
     */ 
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set the value of mileage
     *
     * @param  int  $mileage
     *
     * @return  self
     */ 
    public function setMileage(int $mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }
}
