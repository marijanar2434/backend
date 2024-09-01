<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyVehicleImageCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $imageId;

    /**
     * @var string
     */
    private $vehicleId;


    public function __construct($imageId, $vehicleId)
    {
        $this->imageId = $imageId;
        $this->vehicleId = $vehicleId;
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
     * Get the value of imageId
     *
     * @return  string
     */ 
    public function getImageId()
    {
        return $this->imageId;
    }
}

