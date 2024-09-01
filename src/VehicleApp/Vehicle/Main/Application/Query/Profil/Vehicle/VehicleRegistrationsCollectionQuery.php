<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class VehicleRegistrationsCollectionQuery extends CollectionQuery implements RequiresAuthorization
{
    /**
     * @var string
     */
    private $vehicleId;

    /**
     * @var boolean
     */
    private $attached;

    /**
     * UserRolesCollectionQuery Constructor
     *
     * @param string $vehicleId
     * @param boolean $attached
     * @param int $page
     * @param int $limit
     * @param array $filter
     * @param array $order
     */
    public function __construct($vehicleId, $attached, $page, $limit, $filter = [], $order = [])
    {
        parent::__construct($page, $limit, $filter, $order);
        $this->vehicleId = $vehicleId;
        $this->attached = $attached;
    }

  

    /**
     * @return boolean
     */
    public function getAttached(): bool
    {
        return $this->attached;
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

