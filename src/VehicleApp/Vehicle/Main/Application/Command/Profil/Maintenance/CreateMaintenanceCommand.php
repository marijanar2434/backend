<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Maintenance;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use DateTimeImmutable;

class CreateMaintenanceCommand extends Command implements TransactionalCommand
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
    private   $timeOfUser;

    /**
     * 
     *
     * @var float
     */
    private $fee;

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
    private $maintenanceTypeId;

    /**
     * 
     *
     * @var array
     */
    public $partAndServices;

    public function __construct($id,  $date,  $mileage, $fee,  $userId, $timeOfUser, $vehicleId, $maintenanceTypeId,$partAndServices)
    {
        $this->id = $id;
        $this->date = $date;
        $this->mileage = $mileage;
        $this->fee = $fee;
        $this->userId = $userId;
        $this->timeOfUser = $timeOfUser;
        $this->vehicleId = $vehicleId;
        $this->maintenanceTypeId = $maintenanceTypeId;
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
     * Get the value of maintenanceTypeId
     *
     * @return  string
     */ 
    public function getMaintenanceTypeId()
    {
        return $this->maintenanceTypeId;
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
     * Get the value of timeOfUser
     *
     * @return  integer
     */ 
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
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
     * Get the value of mileage
     *
     * @return  integer
     */ 
    public function getMileage()
    {
        return $this->mileage;
    }
}
