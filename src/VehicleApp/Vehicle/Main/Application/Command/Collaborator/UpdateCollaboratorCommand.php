<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class UpdateCollaboratorCommand extends Command implements TransactionalCommand
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
    private  $client;

    /**
     * 
     *
     * @var string
     */

    private  $company;



    public function __construct($id, $client, $company)
    {

        $this->id  = $id;
        $this->client = $client;
        $this->company = $company;
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
     * Get the value of client
     *
     * @return  string
     */ 
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param  string  $client
     *
     * @return  self
     */ 
    public function setClient(string $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get the value of company
     */ 
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @return  self
     */ 
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

}