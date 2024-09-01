<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class Damage extends Entity
{

    use DateTimeTracking;

    /**
     * 
     *
     * @var string
     */
    private  $description;


    /**
     * 
     *
     * @var DamageCoverage
     */
    private  $damageCoverage;


    /**
     * 
     *
     * @var ArrayCollection<PartAndService>
     */
    private $partAndServices;



    /**
     * 
     *
     * @var float
     */
    private  $fee;



    /**
     * 
     *
     * @var UserVehicle|null
     */
    private  $user;



    /**
     * 
     *
     * @var integer|null
     */
    private  $timeOfUser;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private  $date;


    /**
     * 
     *
     * @var Vehicle
     */
    private  $vehicle;

    public function __construct(
        Id $id,
        string $description,
        DamageCoverage $damageCoverage,
        DateTimeImmutable $date,
        float $fee,
        Vehicle $vehicle,
        ?UserVehicle $user = null,
        ?int $timeOfUser = null,
        array $partAndServices = []
    ) {
        parent::__construct($id);

        $this->setDescription($description);
        $this->setDamageCoverage($damageCoverage);
        $this->setDate($date);
        $this->setFee($fee);
        $this->setVehicle($vehicle);
        $this->setUser($user);
        $this->setTimeOfUser($timeOfUser);
        $this->setPartAndServices($partAndServices);

        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
    }


    public function updateProperties(
        string $description,
        DamageCoverage $damageCoverage,
        DateTimeImmutable $date,
        float $fee,
        Vehicle $vehicle,
        ?UserVehicle $user = null,
        ?int $timeOfUser = null
    ) {
        $this->setDescription($description);
        $this->setDamageCoverage($damageCoverage);
        $this->setDate($date);
        $this->setFee($fee);
        $this->setVehicle($vehicle);
        $this->setUser($user);
        $this->setTimeOfUser($timeOfUser);


        $this->setUpdatedOn(new DateTimeImmutable());
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
     * Get the value of damageCoverage
     *
     * @return  DamageCoverage
     */
    public function getDamageCoverage()
    {
        return $this->damageCoverage;
    }

    /**
     * Set the value of damageCoverage
     *
     * @param  DamageCoverage  $damageCoverage
     *
     * @return  self
     */
    public function setDamageCoverage(DamageCoverage $damageCoverage)
    {
        $this->damageCoverage = $damageCoverage;
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
}
