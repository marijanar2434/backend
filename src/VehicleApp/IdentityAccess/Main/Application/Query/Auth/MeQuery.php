<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Auth;

use App\Common\Application\Query\Query;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class MeQuery extends Query implements RequiresAuthorization
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * MeQuery Constructor
     *
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
