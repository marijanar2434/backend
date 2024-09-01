<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;
use DateTimeImmutable;

class UpdateVehicleCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
    private  $vehicleActiveFrom;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private $vehicleActiveTo;


    /**
     * 
     *
     * @var string
     */
    private $colorId;


    /**
     * 
     *
     * @var string
     */
    private $chassisNumber;

    /**
     * 
     *
     * @var string
     */
    private $engineNumber;

    /**
     * 
     *
     * @var string
     */
    private $yearOfProduction;

    /**
     * 
     *
     * @var integer
     */
    private $price;

    public function __construct($id, $price, $colorId, $chassisNumber, $engineNumber, $yearOfProduction, $vehicleActiveFrom, $vehicleActiveTo)
    {
        $this->id = $id;
        $this->price = $price;
        $this->colorId = $colorId;
        $this->chassisNumber = $chassisNumber;
        $this->engineNumber = $engineNumber;
        $this->yearOfProduction = $yearOfProduction;
        $this->vehicleActiveFrom = $vehicleActiveFrom;
        $this->vehicleActiveTo = $vehicleActiveTo;
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
     * Get the value of vehicleActiveFrom
     *
     * @return  DateTimeImmutable
     */
    public function getVehicleActiveFrom()
    {
        return $this->vehicleActiveFrom;
    }

    /**
     * Get the value of vehicleActiveTo
     *
     * @return  DateTimeImmutable
     */
    public function getVehicleActiveTo()
    {
        return $this->vehicleActiveTo;
    }

    /**
     * Get the value of color
     *
     * @return  string
     */
    public function getColorId()
    {
        return $this->colorId;
    }

    /**
     * Get the value of chassisNumber
     *
     * @return  string
     */
    public function getChassisNumber()
    {
        return $this->chassisNumber;
    }

    /**
     * Get the value of engineNumber
     *
     * @return  string
     */
    public function getEngineNumber()
    {
        return $this->engineNumber;
    }

    /**
     * Get the value of yearOfProduction
     *
     * @return  string
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
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
     * Set the value of vehicleActiveFrom
     *
     * @param  DateTimeImmutable  $vehicleActiveFrom
     *
     * @return  self
     */
    public function setVehicleActiveFrom(DateTimeImmutable $vehicleActiveFrom)
    {
        $this->vehicleActiveFrom = $vehicleActiveFrom;

        return $this;
    }

    /**
     * Set the value of vehicleActiveTo
     *
     * @param  DateTimeImmutable  $vehicleActiveTo
     *
     * @return  self
     */
    public function setVehicleActiveTo(DateTimeImmutable $vehicleActiveTo)
    {
        $this->vehicleActiveTo = $vehicleActiveTo;

        return $this;
    }

    /**
     * Set the value of colorId
     *
     * @param  string  $colorId
     *
     * @return  self
     */
    public function setColorId(string $colorId)
    {
        $this->colorId = $colorId;

        return $this;
    }

    /**
     * Set the value of chassisNumber
     *
     * @param  string  $chassisNumber
     *
     * @return  self
     */
    public function setChassisNumber(string $chassisNumber)
    {
        $this->chassisNumber = $chassisNumber;

        return $this;
    }

    /**
     * Set the value of engineNumber
     *
     * @param  string  $engineNumber
     *
     * @return  self
     */
    public function setEngineNumber(string $engineNumber)
    {
        $this->engineNumber = $engineNumber;

        return $this;
    }

    /**
     * Set the value of yearOfProduction
     *
     * @param  string  $yearOfProduction
     *
     * @return  self
     */
    public function setYearOfProduction(string $yearOfProduction)
    {
        $this->yearOfProduction = $yearOfProduction;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  integer
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  integer  $price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}
