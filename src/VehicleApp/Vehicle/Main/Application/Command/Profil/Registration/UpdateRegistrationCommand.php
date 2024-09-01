<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Registration;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;
use DateInterval;
use DateTimeImmutable;

class UpdateRegistrationCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
    private $vehicleId;

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
     * Set the value of userId
     *
     * @param  string  $userId
     *
     * @return  self
     */
    public function setUserId(string $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Set the value of registrationStartDate
     *
     * @param  DateTimeImmutable  $registrationStartDate
     *
     * @return  self
     */
    public function setRegistrationStartDate(DateTimeImmutable $registrationStartDate)
    {
        $this->registrationStartDate = $registrationStartDate;

        return $this;
    }


    /**
     * Set the value of registrationNumber
     *
     * @param  string  $registrationNumber
     *
     * @return  self
     */
    public function setRegistrationNumber(string $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
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
     * @param  integer  $timeOfUser
     *
     * @return  self
     */
    public function setTimeOfUser($timeOfUser)
    {
        $this->timeOfUser = $timeOfUser;
        return $this;
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
     * Set the value of registrationFee
     *
     * @param  integer  $registrationFee
     *
     * @return  self
     */ 
    public function setRegistrationFee($registrationFee)
    {
        $this->registrationFee = $registrationFee;
        return $this;
    }
}
