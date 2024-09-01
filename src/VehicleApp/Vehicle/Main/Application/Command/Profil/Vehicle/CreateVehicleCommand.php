<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use DateTimeImmutable;

class CreateVehicleCommand extends Command implements TransactionalCommand
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
    private $typeId;


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

    public function __construct($id, $typeId,$price,$colorId,$chassisNumber,$engineNumber,$yearOfProduction, $vehicleActiveFrom, $vehicleActiveTo)
    {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->price = $price;
        $this->colorId=$colorId;
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
     * Get the value of typeId
     *
     * @return  string
     */
    public function getTypeId()
    {
        return $this->typeId;
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
     * Get the value of price
     *
     * @return  integer
     */ 
    public function getPrice()
    {
        return $this->price;
    }
}
