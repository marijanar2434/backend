<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\ExpenseType;

use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpense;
use Doctrine\Common\Collections\ArrayCollection;

class ExpenseType  extends Entity
{

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
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
