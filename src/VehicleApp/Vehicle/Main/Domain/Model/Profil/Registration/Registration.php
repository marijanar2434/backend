<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration;

use DateInterval;
use DateTimeImmutable;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use Doctrine\Common\Collections\ArrayCollection;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Event\Registration\RegistrationCreated;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Documentation\RegDocumentation;

class Registration extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

    /**
     * Registration number
     *
     * @var string
     */
    private $registrationNumber;

    /**     
     *Registration expiration date
     *
     * @var DateTimeImmutable
     */
    private $registrationExpire;


    /**
     * The time since the vehicle has been active
     *
     * @var DateTimeImmutable
     */
    private $registrationStartDate;

    /**
     * 
     *
     * @var Vehicle
     */
    private $vehicle;


    /**
     * 
     *
     * @var UserVehicle
     */
    private  $userVehicle;

    /**
     * 
     *
     * @var integer
     */
    private int $registrationFee;


    /**
     * 
     *
     * @var int
     */
    private $timeOfUser;

    /**
     * 
     *
     * @var bool
     */
    private $active;



    /**
     * 
     *
     * @var ArrayCollection<RegDocumentation>
     */
    private $documentations;

    public function __construct(
        Id $id,
        Vehicle $vehicle,
        UserVehicle $userVehicle,
        string $registrationNumber,
        DateTimeImmutable $registrationStartDate,
        int $registrationFee,
        int $timeOfUser,
        bool $active = false,
        array $documentations = []

    ) {

        parent::__construct($id);
        $this->setVehicle($vehicle);
        $this->setUserVehicle($userVehicle);
        $this->setRegistrationNumber($registrationNumber);
        $this->setRegistrationStartDate($registrationStartDate);
        $this->setRegistrationExpire($registrationStartDate->add(new DateInterval("P1Y")));
        $this->setRegistrationFee($registrationFee);
        $this->setTimeOfUser($timeOfUser);
        $this->setActive($active);
        $this->setDocumentations($documentations);

        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new RegistrationCreated($id,$userVehicle->getFullname()));
    }

    public function updateProperties(
        UserVehicle $user,
        Vehicle $vehicle,
        DateTimeImmutable $registrationStartDate,
        int $registrationFee,
        int $timeOfUser,
        string $registrationNumber,
        bool $active = false
    ) {
        $changes = [];


        if($this->getRegistrationStartDate() != $registrationStartDate)
        {
            $changes[] = ["startDateOld" => $this->getRegistrationStartDate(), "startDateNew" =>$registrationStartDate];
        }
       
        if($this->getRegistrationNumber() != $registrationNumber)
        {
            $changes[] = ["registrationNumberOld" => $this->getRegistrationNumber(), "registrationNumberNew" =>$registrationNumber];
        }

       
        $this->setUserVehicle($user);
        $this->setVehicle($vehicle);
        $this->setRegistrationStartDate($registrationStartDate);
        $this->setRegistrationExpire($registrationStartDate->add(new DateInterval("P1Y")));
        $this->setRegistrationFee($registrationFee);
        $this->setTimeOfUser($timeOfUser);
        $this->setRegistrationNumber($registrationNumber);
        $this->setActive($active);


        $this->setUpdatedOn(new DateTimeImmutable());
    }

    public function addDoc(File $file)
    {
        $fileCheck = base64_encode($file);
        foreach ($this->documentations as $doc) {
            $imCheck = base64_encode($doc->getFile());
            if ($fileCheck == $imCheck) {
                return;
            }
        }

        $this->documentations[] = new RegDocumentation(new Id(), $this, $file);
    }

    public function removeDocumentation(Id $id)
    {   
        foreach ($this->documentations as $key => $doc) {
            if ($doc->getId()->equals($id)) {
                unset($this->documentations[$key]);
                return;
            }
        }
    }


    /**
     * Get registration number
     *
     * @return  string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set registration number
     *
     * @param  string  $registrationNumber  Registration number
     *
     * @return  self
     */
    public function setRegistrationNumber(string $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get *Registration expiration date
     *
     * @return  DateTimeImmutable
     */
    public function getRegistrationExpire()
    {
        return $this->registrationExpire;
    }

    /**
     * Set *Registration expiration date
     *
     * @param  DateTimeImmutable  $registrationExpire  *Registration expiration date
     *
     * @return  self
     */
    public function setRegistrationExpire(DateTimeImmutable $registrationExpire)
    {
        $this->registrationExpire = $registrationExpire;

        return $this;
    }

    /**
     * Get the time since the vehicle has been active
     *
     * @return  DateTimeImmutable
     */
    public function getRegistrationStartDate()
    {
        return $this->registrationStartDate;
    }

    /**
     * Set the time since the vehicle has been active
     *
     * @param  DateTimeImmutable  $registrationStartDate  The time since the vehicle has been active
     *
     * @return  self
     */
    public function setRegistrationStartDate(DateTimeImmutable $registrationStartDate)
    {
        $this->registrationStartDate = $registrationStartDate;

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
     * Get the value of timeOfUser
     *
     * @return  int
     */
    public function getTimeOfUser()
    {
        return $this->timeOfUser;
    }

    /**
     * Set the value of timeOfUser
     *
     * @param  int  $timeOfUser
     *
     * @return  self
     */
    public function setTimeOfUser(int $timeOfUser)
    {
        $this->timeOfUser = $timeOfUser;
        return $this;
    }

    /**
     * Get the value of active
     *
     * @return  bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param  bool  $active
     *
     * @return  self
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get the value of userVehicle
     *
     * @return  UserVehicle
     */
    public function getUserVehicle()
    {
        return $this->userVehicle;
    }

    /**
     * Set the value of userVehicle
     *
     * @param  UserVehicle  $userVehicle
     *
     * @return  self
     */
    public function setUserVehicle(UserVehicle $userVehicle)
    {
        $this->userVehicle = $userVehicle;
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

    /**
     * Get the value of documentations
     *
     * @return  RegDocumentation[]
     */
    public function getDocumentations(): array
    {
        return $this->documentations->toArray();
    }

    /**
     * Set the value of documentations
     *
     * @param  RegDocumentation[]  $documentations
     *
     * @return  self
     */
    public function setDocumentations(array $documentations)
    {
        $this->documentations = new ArrayCollection($documentations);
        return $this;
    }
}
