<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Type;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;

class Type extends Entity
{

    use DateTimeTracking;
    /**
     * Type name
     *
     * @var string
     */
    private $name;

    /**
     * 
     *
     * @var Brand
     */
    private $brand;


    /**
     * 
     *
     * @param Id $id
     * @param string $name
     * @param Brand $brand
     */
    public function __construct(Id $id, string $name, Brand $brand)
    {
        parent::__construct($id);
        $this->setName($name);
        $this->setBrand($brand);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
    }


    /**
     * Get Type name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Type name
     *
     * @param  string  $name  Type name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of brand
     *
     * @return  Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @param  Brand  $brand
     *
     * @return  self
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
        return $this;
    }


    public function updateProperties(string $name, Brand $brand): void
    {
        $this->setName($name);
        $this->setBrand($brand);
        $this->setUpdatedOn(new DateTimeImmutable());
    }
}
