<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CreateDocumentationVehicleCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
    private $documentation;


    public function __construct($id, $documentation)
    {
        $this->id = $id;
        $this->documentation = $documentation;
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
     * Get the value of documentation
     *
     * @return  string
     */ 
    public function getDocumentation()
    {
        return $this->documentation;
    }
}

