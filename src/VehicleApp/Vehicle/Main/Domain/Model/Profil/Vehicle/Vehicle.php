<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle;

use DateTimeImmutable;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use Doctrine\Common\Collections\ArrayCollection;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\Color;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\Image;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Event\Vehicle\VehicleCreated;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Documentation\VehicleDocumentation;

class Vehicle extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;


    /**
     * Time the vehicle is active
     *
     * @var DateTimeImmutable|null
     */
    private $vehicleActiveTo;


    /**
     * The time since the vehicle has been active
     *
     * @var DateTimeImmutable
     */
    private $vehicleActiveFrom;

    /**
     * 
     *
     * @var Type
     */
    private $type;

    /**
     * 
     *
     * @var ArrayCollection<Registration>
     */
    private $registrations;

    /**
     * 
     *
     * @var Color
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
     * @var string
     */
    private $yearOfProduction;


    /**
     * 
     *
     * @var integer
     */
    private  $price;


    /**
     * 
     *
     * @var bool
     */
    private $active;

    /**
     * 
     *
     * @var ArrayCollection<UserVehicle>
     */
    private $users;


    /**
     * @var ArrayCollection<FuelAndExpense>
     */
    private $fuelAndExpenses;

    /**
     * @var ArrayCollection<Maintenance>
     */
    private $maintenances;


    /**
     * 
     *
     * @var ArrayCollection<Damage>
     */
    private $damages;


    /**
     * 
     *
     * @var ArrayCollection<Image>
     */
    private  $images;

    /**
     * 
     *
     * @var ArrayCollection<VehicleDocumentation>
     */
    private $documentations;

    public function __construct(
        Id $id,
        Type $type,
        int $price,
        Color $color,
        string $engineNumber,
        string $chassisNumber,
        string $yearOfProduction,
        DateTimeImmutable $vehicleActiveFrom,
        ?DateTimeImmutable $vehicleActiveTo = null,
        array $damages = [],
        array $maintenances = [],
        array $users = [],
        array $registrations = [],
        bool $active = true,
        array $fuelandexpenses = [],
        array $images = [],
        array $documentations = []
    ) {

        parent::__construct($id);
        $this->setUsers($users);
        $this->setType($type);
        $this->setPrice($price);
        $this->setColor($color);
        $this->setVehicleActiveFrom($vehicleActiveFrom);
        $this->setVehicleActiveTo($vehicleActiveTo);
        $this->setRegistrations($registrations);
        $this->setMaintenances($maintenances);
        $this->setDamages($damages);
        $this->setChassisNumber($chassisNumber);
        $this->setEngineNumber($engineNumber);
        $this->setYearOfProduction($yearOfProduction);
        $this->setActive($active);
        $this->setFuelAndExpenses($fuelandexpenses);
        $this->setImages($images);
        $this->setDocumentations($documentations);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());



        $this->recordThat(new VehicleCreated(
            $id,
            $chassisNumber,
            $engineNumber,
            $type->getBrand()->getName() . " " . $type->getName()
        ));
    }


    public function updateProperties(
        int $price,
        Color $color,
        string $engineNumber,
        string $chassisNumber,
        string $yearOfProduction,
        DateTimeImmutable $vehicleActiveFrom,
        ?DateTimeImmutable $vehicleActiveTo = null
    ) {

        $this->setPrice($price);
        $this->setColor($color);
        $this->setVehicleActiveFrom($vehicleActiveFrom);
        $this->setVehicleActiveTo($vehicleActiveTo);
        $this->setChassisNumber($chassisNumber);
        $this->setEngineNumber($engineNumber);
        $this->setYearOfProduction($yearOfProduction);


        $this->setUpdatedOn(new DateTimeImmutable());
    }

    public function addImage(File $file)
    {
        
        $fileCheck = hash_file('sha256',$file);
        foreach ($this->images as $im) {
            $imCheck = hash_file('sha256',$im->getImage());
            if ($fileCheck == $imCheck) {
                return;
            }
        }

        $this->images[] = new Image(new Id(), $this, $file);
    }


    public function removeImage(Id $id)
    {   
        foreach ($this->images as $key => $im) {
            if ($im->getId()->equals($id)) {
                unset($this->images[$key]);
                return;
            }
        }
    }


    public function addDoc(File $file)
    {
        $fileCheck = hash_file('sha256', $file); 
        foreach ($this->documentations as $doc) {
            $imCheck = hash_file('sha256',$doc->getFile());
            if ($fileCheck == $imCheck) {
                return;
            }
        }
        $this->documentations[] = new VehicleDocumentation(new Id(), $this, $file);
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
     * @param UserVehicle $user
     * 
     * @return boolean
     */
    public function hasUser(UserVehicle $user): bool
    {
        foreach ($this->users as $u) {
            if ($u->getId() === $user->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * 
     *
     * @param UserVehicle $user
     * @return void
     */
    public function attachUser(UserVehicle $user): void
    {
        foreach ($this->users as $u) {
            if ($u->getId()->equals($user->getId())) {
                return;
            }
        }

        $this->users[] = $user;
    }

    /**
     * @param UserVehicle $user
     * 
     * @return  void
     */

    public function detachUser(UserVehicle $user): void
    {
        foreach ($this->users as $key => $u) {
            if ($u->getId()->equals($user->getId())) {
                unset($this->users[$key]);
                return;
            }
        }
    }


    /**
     * Get time the vehicle is active
     *
     * @return  DateTimeImmutable|null
     */
    public function getVehicleActiveTo(): ?DateTimeImmutable
    {
        return $this->vehicleActiveTo;
    }

    /**
     * Set time the vehicle is active
     *
     * @param  DateTimeImmutable|null  $vehicleActiveTo  Time the vehicle is active
     *
     * @return  self
     */
    public function setVehicleActiveTo(?DateTimeImmutable $vehicleActiveTo): self
    {
        $this->vehicleActiveTo = $vehicleActiveTo;
        return $this;
    }

    /**
     * Get the time since the vehicle has been active
     *
     * @return  DateTimeImmutable
     */
    public function getVehicleActiveFrom(): DateTimeImmutable
    {
        return $this->vehicleActiveFrom;
    }

    /**
     * Set the time since the vehicle has been active
     *
     * @param  DateTimeImmutable  $vehicleActiveFrom  The time since the vehicle has been active
     *
     * @return  self
     */
    public function setVehicleActiveFrom(DateTimeImmutable $vehicleActiveFrom): self
    {
        $this->vehicleActiveFrom = $vehicleActiveFrom;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  Type  $type
     *
     * @return  self
     */
    public function setType(Type $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the value of registrations
     *
     * @return  Registration[]
     */
    public function getRegistrations(): array
    {
        return $this->registrations->toArray();
    }

    /**
     * Set the value of registration
     *
     * @param  Registration[]  $registrations
     *
     * @return  self
     */
    public function setRegistrations(array $registrations)
    {
        $this->registrations = new ArrayCollection($registrations);
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
     * Get the value of color
     *
     * @return  Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @param  Color  $color
     *
     * @return  self
     */
    public function setColor(Color $color)
    {
        $this->color = $color;
        return $this;
    }


    /**
     * Get the value of users
     *
     * @return   UserVehicle[]
     */
    public function getUsers(): array
    {
        return $this->users->toArray();
    }

    /**
     * Set the value of users
     *
     * @param  UserVehicle[] $users
     *
     * @return  self
     */
    public function setUsers(array $users)
    {
        $this->users = new ArrayCollection($users);
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
     * Undocumented function
     *
     * @return array
     */
    public function getFuelAndExpenses(): array
    {
        return $this->fuelAndExpenses->toArray();
    }

    /**
     * Set the value of fuelAndExpenses
     *
     * @param  FuelAndExpense[] $fuelAndExpenses
     *
     * @return  self
     */
    public function setFuelAndExpenses(array $fuelAndExpenses)
    {
        $this->fuelAndExpenses = new ArrayCollection($fuelAndExpenses);
        return $this;
    }

    /**
     * Get the value of maintenances
     *
     * @return  Maintenance[]
     */
    public function getMaintenances(): array
    {
        return $this->maintenances->toArray();
    }

    /**
     * Set the value of maintenances
     *
     * @param  Maintenance[]  $maintenances
     *
     * @return  self
     */
    public function setMaintenances(array $maintenances)
    {
        $this->maintenances = new ArrayCollection($maintenances);
        return $this;
    }

    /**
     * Get the value of damages
     *
     * @return  Damage[]
     */
    public function getDamages(): array
    {
        return $this->damages->toArray();
    }

    /**
     * Set the value of damages
     *
     * @param  Damage[]  $damages
     *
     * @return  self
     */
    public function setDamages(array $damages)
    {
        $this->damages = new ArrayCollection($damages);
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
     *
     * @return  Image[]
     */
    public function getImages(): array
    {
        return $this->images->toArray();
    }

    /**
     * Set the value of images
     *
     * @param  Image[]  $images
     *
     * @return  self
     */
    public function setImages(array $images)
    {
        $this->images = new ArrayCollection($images);
        return $this;
    }

    /**
     * Get the value of documentations
     *
     * @return   VehicleDocumentation[]
     */
    public function getDocumentations(): array
    {
        return $this->documentations->toArray();
    }

    /**
     * Set the value of documentations
     *
     * @param  VehicleDocumentation[]  $documentations
     *
     * @return  self
     */
    public function setDocumentations(array $documentations)
    {
        $this->documentations = new ArrayCollection($documentations);
        return $this;
    }
}
