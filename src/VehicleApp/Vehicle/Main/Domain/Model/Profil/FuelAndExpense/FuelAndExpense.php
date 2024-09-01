<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\ExpenseCannotBeNegativeException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\MilageCannotBeNegativeException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\FuelAndExpense\PriceCannotBeNegativeException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class FuelAndExpense extends Entity
{
    use DateTimeTracking, DomainEventRecording;

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
    private  $mileage;

    /**
     * 
     *
     * @var float|null
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
     * @var UserVehicle|null
     */
    private  $user;


    /**
     * 
     *
     * @var Vehicle
     */
    private $vehicle;

    /**
     * 
     *
     * @var integer|null
     */
    private  $timeOfUser;


    /**
     * 
     *
     * @var ExpenseType
     */
    private  $expenseType;




    public function __construct(
        Id $id,
        DateTimeImmutable $date,
        int $mileage,
        float $price,
        Vehicle $vehicle,
        ExpenseType $expenseType,
        float $expense = 0,
        UserVehicle $user = null,
        int $timeOfUser = null,

    ) {

        parent::__construct($id);

        $this->setDate($date);
        $this->setMileage($mileage);
        $this->setExpense($expense);
        $this->setPrice($price);
        $this->setUser($user);
        $this->setTimeOfUser($timeOfUser);
        $this->setVehicle($vehicle);
        $this->setExpenseType($expenseType);


        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
    }


    public function updateProperties(
        DateTimeImmutable $date,
        int $mileage,
        float $expense = null,
        float $price,
        UserVehicle $user = null,
        int $timeOfUser = null,
        Vehicle $vehicle
    ) {
        $this->setDate($date);
        $this->setMileage($mileage);
        $this->setExpense($expense);
        $this->setPrice($price);
        $this->setUser($user);
        $this->setTimeOfUser($timeOfUser);
        $this->setVehicle($vehicle);

        $this->setUpdatedOn(new DateTimeImmutable());
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
     * Get the value of user
     *
     * @return  UserVehicle
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  UserVehicle|null  $user
     *
     * @return  self
     */
    public function setUser(?UserVehicle $user)
    {
        $this->user = $user;
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
     * @param  integer|null  $timeOfUser
     *
     * @return  self
     */
    public function setTimeOfUser(?int $timeOfUser)
    {
        $this->timeOfUser = $timeOfUser;
        return $this;
    }

    /**
     * Get the value of vehicle
     *
     * @return  Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set the value of vehicle
     *
     * @param  Vehicle  $vehicle
     *
     * @return  self
     */
    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * Get the value of expenseType
     *
     * @return  ExpenseType
     */
    public function getExpenseType()
    {
        return $this->expenseType;
    }

    /**
     * Set the value of expenseType
     *
     * @param  ExpenseType  $expenseType
     *
     * @return  self
     */
    public function setExpenseType(ExpenseType $expenseType)
    {
        $this->expenseType = $expenseType;
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
        if ($mileage <= 0) {
            throw new MilageCannotBeNegativeException();
        }

        $this->mileage = $mileage;

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

        if ($price <= 0) {
            throw new PriceCannotBeNegativeException();
        }
        $this->price = $price;
        return $this;
    }


    /**
     * Get the value of expense
     *
     * @return  float|null
     */
    public function getExpense()
    {
        return $this->expense;
    }

    /**
     * Set the value of expense
     *
     * @param  float|null  $expense
     *
     * @return  self
     */
    public function setExpense($expense)
    {
        if ($expense <= 0) {
            throw new ExpenseCannotBeNegativeException();
        }
        $this->expense = $expense;
        return $this;
    }
}
