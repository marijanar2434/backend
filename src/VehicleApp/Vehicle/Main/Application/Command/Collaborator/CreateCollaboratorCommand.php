<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Collaborator;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class CreateCollaboratorCommand extends Command implements TransactionalCommand
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


    /**
     * 
     *
     * @var array
     */
    public $types;


    public function __construct($id, $client, $company, $types)
    {

        $this->id  = $id;
        $this->client = $client;
        $this->company = $company;
        $this->types = $types;
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
     * Get the value of client
     *
     * @return  string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get the value of company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get the value of types
     *
     * @return  array
     */
    public function getTypes()
    {
        return $this->types;
    }
}
