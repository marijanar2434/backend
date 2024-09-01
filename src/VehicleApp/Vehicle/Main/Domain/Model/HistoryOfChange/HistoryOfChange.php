<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Entity;
use App\Common\Domain\RecordingDomainEvents;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change\Change;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class HistoryOfChange extends Entity implements RecordingDomainEvents
{

    use DateTimeTracking, DomainEventRecording;



    /**
     * 
     *
     * @var ArrayCollection<Change>
     */
    private  $changes;


    /**
     * 
     *
     * @var UserVehicle
     */
    private  $user;


    public function __construct(Id $id, UserVehicle $user,  array $changes = [])
    {
        parent::__construct($id);

        $this->setUser($user);
        $this->setChanges($changes);
        
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
    }



    /**
     * Get the value of changes
     *
     * @return  Change[]
     */
    public function getChanges(): array
    {
        return $this->changes->toArray();
    }

    /**
     * Set the value of changes
     *
     * @param  Change[]  $changes
     *
     * @return  self
     */
    public function setChanges(array $changes)
    {
        $this->changes = new ArrayCollection($changes);
        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  UserVehicle
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  UserVehicle  $user
     *
     * @return  self
     */
    public function setUser(UserVehicle $user)
    {
        $this->user = $user;
        return $this;
    }
}
