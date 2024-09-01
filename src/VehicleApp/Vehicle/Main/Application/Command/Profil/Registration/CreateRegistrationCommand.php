<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use DateInterval;
use DateTimeImmutable;

class CreateRegistrationCommand extends Command implements TransactionalCommand
{

    /**
     * 
     *
     * @var string
     */
    private $id;

    /**
     * 
     *
     * @var string
     */
    private $vehicleId;

    /**
     * 
     *
     * @var string
     */
    private $userId;

    /**
     * 
     *
     * @var DateTimeImmutable
     */
    private  $registrationStartDate;

/**
     * 
     *
     * @var DateTimeImmutable
     */
    private  $registrationExpire;

    /**
     * 
     *
     * @var integer
     */
    private $registrationFee;


    /**
     * 
     *
     * @var integer
     */
    private $timeOfUser;


    /**
     * 
     *
     * @var string
     */
    private $registrationNumber;


    public function __construct($id, $vehicleId, $userId, $registrationStartDate, $registrationFee, $timeOfUser, $registrationNumber)
    {
        $this->id = $id;
        $this->vehicleId = $vehicleId;
        $this->userId = $userId;
        $this->registrationStartDate = $registrationStartDate;
        $this->registrationExpire = $registrationStartDate->add(new DateInterval("P1Y"));
        $this->registrationFee = $registrationFee;
        $this->timeOfUser = $timeOfUser;
        $this->registrationNumber = $registrationNumber;
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
     * Get the value of vehicleId
     *
     * @return  string
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
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
     * Get the value of registrationStartDate
     *
     * @return  DateTimeImmutable
     */
    public function getRegistrationStartDate()
    {
        return $this->registrationStartDate;
    }

    /**
     * Get the value of registrationNumber
     *
     * @return  string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Get the value of registrationExpire
     *
     * @return  DateTimeImmutable
     */ 
    public function getRegistrationExpire()
    {
        return $this->registrationExpire;
    }

    /**
     * Get the value of registrationFee
     *
     * @return  integer
     */ 
    public function getRegistrationFee()
    {
        return $this->registrationFee;
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
