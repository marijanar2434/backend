<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;

class Image extends Entity
{


    /**
     * @var File
     */
    private  $image;


    /**
     * 
     *
     * @var Vehicle
     */
    private  $vehicle;

    public function __construct(Id $id, Vehicle $vehicle, File $image)
    {
        parent::__construct($id);

        $this->setImage($image);
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
     * Get the value of image
     *
     * @return  File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  File  $image
     *
     * @return  self
     */
    public function setImage(File $image)
    {
        $this->image = $image;
        return $this;
    }
}
