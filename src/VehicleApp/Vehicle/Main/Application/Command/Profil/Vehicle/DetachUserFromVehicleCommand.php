<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class DetachUserFromVehicleCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $vehicleId;

    /**
     * AttachRoleToUserCommand Constructor
     *
     * @param string $userId
     * @param string $vehicleId
     */
    public function __construct($userId, $vehicleId)
    {
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
    }

    /**
     * @return  string
     */
    public function getUserId(): string
    {
        return $this->userId;
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
}
