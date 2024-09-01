<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Documentation;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;

class VehicleDocumentation extends Entity
{


    /**
     * @var File
     */
    private  $file;


    /**
     * 
     *
     * @var Vehicle
     */
    private  $vehicle;

    public function __construct(Id $id, Vehicle $vehicle, File $file)
    {
        parent::__construct($id);

        $this->setFile($file);
        $this->setVehicle($vehicle);
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
     * Get the value of file
     *
     * @return  File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @param  File  $file
     *
     * @return  self
     */
    public function setFile(File $file)
    {
        $this->file = $file;
        return $this;
    }
}
