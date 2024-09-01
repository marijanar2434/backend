<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class AttachUserToVehicleCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $vehicleId;

    /**
     * @var string
     */
    private $userId;



    /**
     * AttachRoleToUserCommand Constructor
     *
     * @param string $vehicleId
     * @param string $userId
     */
    public function __construct($vehicleId, $userId)
    {
        $this->vehicleId = $vehicleId;
        $this->userId = $userId;
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
     * Get the value of userId
     *
     * @return  string
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
