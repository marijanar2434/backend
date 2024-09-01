<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Image;

use App\Common\Application\Dto\Dto;

class ImageDto extends Dto
{

    /**
     * 
     *
     * @var string
     */
    private  $id;

    /**
     * 
     *
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
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage(string $image)
    {
        $this->image = $image;
        return $this;
    }
}


