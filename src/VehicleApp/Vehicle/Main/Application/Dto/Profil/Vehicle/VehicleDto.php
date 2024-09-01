<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle;

use App\Common\Application\Dto\Dto;
use DateTimeImmutable;

class VehicleDto extends Dto
{
    /**
     * 
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $createdOn;

    /**
     * @var string
     */
    private $updatedOn;

    /**
     * 
     *
     * @var string
     */
    private  $type;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private $vehicleActiveFrom;

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
    private $color;

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
    private $chassisNumber;

    /**
     * 
     *
     * @var integer
     */
    private  $price;

    /**
     * 
     *
     * @var string
     */
    private $brand;

    /**
     * 
     *
     * @var string
     */
    private $yearOfProduction;

    /**
     * 
     *
     * @var string
     */
    private $typeOfUser;

    /**
     * 
     *
     * @var array
     */
    private  $users;

    /**
     * 
     *
     * @var array
     */
    private  $images;


    /**
     * 
     *
     * @var array
     */
    private array $documentations;

    public function __construct(
        $id,
        $type,
        $brand,
        $color,
        $price,
        $engineNumber,
        $chassisNumber,
        $yearOfproduction,
        $vehicleActiveTo,
        $vehicleActiveFrom,
        $typeOfUser,
        $users,
        $images,
        $documentations
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->brand = $brand;
        $this->color = $color;
        $this->price = $price;
        $this->engineNumber = $engineNumber;
        $this->chassisNumber = $chassisNumber;
        $this->yearOfProduction = $yearOfproduction;
        $this->vehicleActiveFrom = $vehicleActiveFrom;
        $this->vehicleActiveTo = $vehicleActiveTo;
        $this->users = $users;
        $this->typeOfUser = $typeOfUser;
        $this->images = $images;
        $this->documentations = $documentations;
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
     * Get the value of createdOn
     *
     * @return  string
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set the value of createdOn
     *
     * @param  string  $createdOn
     *
     * @return  self
     */
    public function setCreatedOn(string $createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get the value of updatedOn
     *
     * @return  string
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set the value of updatedOn
     *
     * @param  string  $updatedOn
     *
     * @return  self
     */
    public function setUpdatedOn(string $updatedOn)
    {
        $this->updatedOn = $updatedOn;

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
     * Get the value of vehicleActiveFrom
     *
     * @return  DateTimeImmutable
     */
    public function getVehicleActiveFrom()
    {
        return $this->vehicleActiveFrom;
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
     * Get the value of vehicleActiveTo
     *
     * @return  DateTimeImmutable
     */
    public function getVehicleActiveTo()
    {
        return $this->vehicleActiveTo;
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
     * Get the value of color
     *
     * @return  string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @param  string  $color
     *
     * @return  self
     */
    public function setColor(string $color)
    {
        $this->color = $color;

        return $this;
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
     * Get the value of chassisNumber
     *
     * @return  string
     */
    public function getChassisNumber()
    {
        return $this->chassisNumber;
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
     * Get the value of yearOfProduction
     *
     * @return  string
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
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
     * Get the value of brand
     *
     * @return  string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @param  string  $brand
     *
     * @return  self
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get the value of users
     *
     * @return  array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set the value of users
     *
     * @param  array  $users
     *
     * @return  self
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * Get the value of typeOfUser
     *
     * @return  string
     */
    public function getTypeOfUser()
    {
        return $this->typeOfUser;
    }

    /**
     * Set the value of typeOfUser
     *
     * @param  string  $typeOfUser
     *
     * @return  self
     */
    public function setTypeOfUser(string $typeOfUser)
    {
        $this->typeOfUser = $typeOfUser;
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

    /**
     * Get the value of images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * Get the value of documentations
     *
     * @return  array
     */
    public function getDocumentations()
    {
        return $this->documentations;
    }

    /**
     * Set the value of documentations
     *
     * @param  array  $documentations
     *
     * @return  self
     */
    public function setDocumentations(array $documentations)
    {
        $this->documentations = $documentations;
        return $this;
    }
}
