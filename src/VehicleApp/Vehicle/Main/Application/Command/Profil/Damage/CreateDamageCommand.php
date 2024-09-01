<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use DateTimeImmutable;

class CreateDamageCommand extends Command implements TransactionalCommand
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
     * @var string
     */
    private  $description;

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


    /**
     * 
     *
     * @var string
     */
    private $damageCoverage;

    /**
     * 
     *
     * @var array
     */
    public $partAndServices;

    
    public function __construct($id,  $date,  $description, $fee,  $userId, $timeOfUser, $vehicleId, $damageCoverage,$partAndServices)
    {
        $this->id = $id;
        $this->date = $date;
        $this->description = $description;
        $this->fee = $fee;
        $this->userId = $userId;
        $this->timeOfUser = $timeOfUser;
        $this->vehicleId = $vehicleId;
        $this->damageCoverage = $damageCoverage;
        $this->partAndServices = $partAndServices;
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
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
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
     * Get the value of damageCoverage
     *
     * @return  string
     */ 
    public function getDamageCoverage()
    {
        return $this->damageCoverage;
    }

    /**
     * Get the value of partAndServices
     *
     * @return  array
     */ 
    public function getPartAndServices()
    {
        return $this->partAndServices;
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
     * Get the value of timeOfUser
     *
     * @return  integer
     */ 
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
    }
}