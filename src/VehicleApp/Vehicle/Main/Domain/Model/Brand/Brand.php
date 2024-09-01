<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Brand;

use DateTimeImmutable;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use App\VehicleApp\Vehicle\Main\Domain\Event\Brand\BrandCreated;

class Brand extends Entity implements RecordingDomainEvents
{

    use DateTimeTracking, DomainEventRecording;

    /**
     * Brand name
     *
     * @var string
     */
    private $name;

   
    /**
     * 
     *
     * @var array
     */
    private   $changes;

   /**
    * 
    *
    * @param Id $id
    * @param string $name
    */
    public function __construct(Id $id, string $name)
    {
        parent::__construct($id);
        $this->setName($name);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new BrandCreated($this->id, $this->name));
    }
    
    /**
     * Get Brand name
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Brand name
     *
     * @param  string  $name  Brand name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        if($name !== $this->name && $this->name !== null){
            $this->setChanges([$this->name => $name]);
        }
        
        $this->name = $name;
        return $this;
    }

    public function updateProperties(string $name): void
    {
        $this->setName($name);
        $this->setUpdatedOn(new DateTimeImmutable());
        dd($this->getChanges());
    }



    /**
     * Get the value of changes
     *
     * @return  array
     */ 
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * Set the value of changes
     *
     * @param  array  $changes
     *
     * @return  self
     */ 
    public function setChanges(array $changes)
    {
        $this->changes = $changes;
        return $this;
    }
}
