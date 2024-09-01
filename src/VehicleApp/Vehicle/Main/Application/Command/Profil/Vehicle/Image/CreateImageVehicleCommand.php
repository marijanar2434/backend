<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CreateImageVehicleCommand extends Command implements TransactionalCommand, RequiresAuthorization
{

    /**
     * 
     *
     * @var string
     */
    private  $id;

    /**
     * @var string
     */
    private $image;


    public function __construct($id, $image)
    {
        $this->id = $id;
        $this->image = $image;
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
     * Get the value of image
     *
     * @return  string
     */
    public function getImage()
    {
        return $this->image;
    }
}
