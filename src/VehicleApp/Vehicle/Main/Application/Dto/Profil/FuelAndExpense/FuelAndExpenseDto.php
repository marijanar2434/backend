<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense;

use App\Common\Application\Dto\Dto;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;

class FuelAndExpenseDto extends Dto
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
     * @var float
     */
    private  $expense;

    /**
     * 
     *
     * @var float
     */
    private  $price;

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
    private  $user;


    /**
     * 
     *
     * @var string
     */
    private  $expenseType;
    /**
     * 
     *
     * @var integer
     */
    private  $timeOfUser;

    /**
     * 
     *
     * @var string
     */
    private  $vehicle;

    public function __construct($id, $date, $mileage, $expense, $price, $user, $timeOfUser, $vehicle, $expenseType)
    {
        $this->id = $id;
        $this->date = $date;
        $this->mileage = $mileage;
        $this->expense = $expense;
        $this->price = $price;
        $this->user = $user;
        $this->timeOfUser = $timeOfUser;
        $this->vehicle = $vehicle;
        $this->expenseType = $expenseType;
    }



    /**
     * 
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
     * Get the value of timeOfUser
     *
     * @return  integer
     */
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
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
    public function setExpense($expense)
    {
        $this->expense = $expense;
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
     * Get the value of expenseType
     *
     * @return  string
     */ 
    public function getExpenseType()
    {
        return $this->expenseType;
    }

    /**
     * Set the value of expenseType
     *
     * @param  string  $expenseType
     *
     * @return  self
     */ 
    public function setExpenseType(string $expenseType)
    {
        $this->expenseType = $expenseType;
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
}
