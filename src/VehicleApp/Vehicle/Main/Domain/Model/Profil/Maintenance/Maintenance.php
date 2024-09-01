<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceType;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class Maintenance extends Entity
{

    use DateTimeTracking;


    /**
     * 
     *
     * @var integer
     */
    private   $mileage;

    /**
     * 
     *
     * @var float
     */
    private  $fee;


    /**
     * 
     *
     * @var integer|null
     */
    private  $timeOfUser;


    /**
     * 
     *
     * @var UserVehicle|null
     */
    private  $user;


    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private $date;


    /**
     * 
     *
     * @var MaintenanceType
     */
    private  $type;


        /**
     *
     *
     * @var ArrayCollection<PartAndService>
     */
    private $partAndServices;


    /**
     * 
     *
     * @var Vehicle
     */
    private  $vehicle;

    public function __construct(
        Id $id,
        MaintenanceType $type,
        Vehicle $vehicle,
        DateTimeImmutable $date,
        int $mileage,
        float $fee,
        ?int $timeOfUser = null,
        ?UserVehicle $user = null,
        array $partAndServices = []
    ) {
        parent::__construct($id);

        $this->setType($type);
        $this->setVehicle($vehicle);
        $this->setDate($date);
        $this->setMileage($mileage);
        $this->setFee($fee);
        $this->setTimeOfUser($timeOfUser);
        $this->setUser($user);
        $this->setPartAndServices($partAndServices);

        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
        
    }


    public function updateProperties(
        Vehicle $vehicle,
        DateTimeImmutable $date,
        int $mileage,
        float $fee,
        ?int $timeOfUser = null,
        ?UserVehicle $user = null
    ) {
        $this->setVehicle($vehicle);
        $this->setDate($date);
        $this->setMileage($mileage);
        $this->setFee($fee);
        $this->setTimeOfUser($timeOfUser);
        $this->setUser($user);


        $this->setUpdatedOn(new DateTimeImmutable());
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
     * Get the value of user
     *
     * @return  UserVehicle|null
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
    public function setUser($user)
    {
        $this->user = $user;
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
     * Get the value of type
     *
     * @return  MaintenanceType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  MaintenanceType  $type
     *
     * @return  self
     */
    public function setType(MaintenanceType $type)
    {
        $this->type = $type;
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
     * Get the value of partAndServices
     *
     * @return  PartAndService[]
     */
    public function getPartAndServices(): array
    {
        return $this->partAndServices->toArray();
    }

    /**
     * Set the value of partAndServices
     *
     * @param  PartAndService[]  $partAndServices
     *
     * @return  self
     */
    public function setPartAndServices(array $partAndServices)
    {
        $this->partAndServices = new ArrayCollection($partAndServices);
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
