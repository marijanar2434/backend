<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Access;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UpdateRoleCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var boolean
     */
    private $active;

    /**
     * UpdateRoleCommand Constructor
     *
     * @param string $id
     * @param string $name
     * @param string $identifier
     * @param bool $active
     */
    public function __construct($id, $name, $identifier, $active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->identifier = $identifier;
        $this->active = $active;
    }

    /**
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return boolean
     */
    public function getActive(): bool
    {
        return $this->active;
    }
}
