<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Documentation;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DestroyVehicleDocumentationCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $docId;

    /**
     * @var string
     */
    private $vehicleId;


    public function __construct($docId, $vehicleId)
    {
        $this->docId = $docId;
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
     * Get the value of docId
     *
     * @return  string
     */ 
    public function getDocId()
    {
        return $this->docId;
    }
}


