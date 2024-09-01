<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;

class MaintenanceType extends Entity
{

    use DateTimeTracking;


    /**
     * 
     *
     * @var string
     */
    private  $name;


    

    public function __construct(Id $id, string $name)
    {
        parent::__construct($id);
        $this->setName($name);
    }

    public function updateProperties(string $name)
    {
        $this->setName($name);
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}
