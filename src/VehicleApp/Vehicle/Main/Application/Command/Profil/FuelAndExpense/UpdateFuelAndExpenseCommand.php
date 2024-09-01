<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;
use DateTimeImmutable;

class UpdateFuelAndExpenseCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
    private  $date;

    /**
     * 
     *
     * @var integer|null
     */
    private $timeOfUser;

    /**
     * 
     *
     * @var float
     */
    private $price;

    /**
     * 
     *
     * @var float
     */
    private  $expense;

    /**
     * 
     *
     * @var string
     */
    private  $userId;

   /**
    * 
    *
    * @var integer
    */
    private  $mileage;

    /**
     * 
     *
     * @var string
     */
    private  $vehicleId;


    public function __construct($id, $date, $timeOfUser, $price, $expense, $userId, $mileage, $vehicleId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->timeOfUser = $timeOfUser;
        $this->price = $price;
        $this->expense = $expense;
        $this->userId = $userId;
        $this->mileage = $mileage;
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
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of expense
     *
     * @return  float
     */ 
    public function getExpense()
    {
        return $this->expense;
    }

    /**
     * Set the value of expense
     *
     * @param  float  $expense
     *
     * @return  self
     */ 
    public function setExpense(float $expense)
    {
        $this->expense = $expense;
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
