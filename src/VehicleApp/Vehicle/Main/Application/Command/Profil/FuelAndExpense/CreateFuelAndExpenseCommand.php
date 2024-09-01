<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;

class CreateFuelAndExpenseCommand extends Command implements TransactionalCommand
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
     * @var integer
     */
    private  $timeOfUser;

    /**
     * 
     *
     * @var float
     */
    private  $price;

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


    /**
     * 
     *
     * @var string
     */
    private $expenseTypeId;


    public function __construct($id,  $date,  $mileage, $expense,  $price,  $userId, $timeOfUser, $vehicleId, $expenseTypeId)
    {
        $this->id = $id;
        $this->date = $date;
        $this->mileage = $mileage;
        $this->expense = $expense;
        $this->price = $price;
        $this->userId = $userId;
        $this->timeOfUser = $timeOfUser;
        $this->vehicleId = $vehicleId;
        $this->expenseTypeId = $expenseTypeId;
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
     * Get the value of date
     *
     * @return  DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
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
     * Get the value of expense
     *
     * @return  float
     */
    public function getExpense()
    {
        return $this->expense;
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
     * Get the value of vehicleId
     *
     * @return  string
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    /**
     * Get the value of expenseTypeId
     *
     * @return  string
     */
    public function getExpenseTypeId()
    {
        return $this->expenseTypeId;
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
     * Get the value of mileage
     *
     * @return  integer
     */ 
    public function getMileage()
    {
        return $this->mileage;
    }
}
