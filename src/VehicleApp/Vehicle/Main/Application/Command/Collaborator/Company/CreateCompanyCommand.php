<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator\Company;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateCompanyCommand extends Command implements TransactionalCommand
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
    private  $name;

    /**
     * 
     *
     * @var string
     */
    private  $companyCode;


    public function __construct($id, $name, $companyCode)
    {
        $this->id = $id;
        $this->name = $name;
        $this->companyCode = $companyCode;
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
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of companyCode
     *
     * @return  string
     */ 
    public function getCompanyCode()
    {
        return $this->companyCode;
    }
}



