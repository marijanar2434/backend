<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Dto\Access;

use App\Common\Application\Dto\Dto;

class RoleDto extends Dto
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
     * @var string
     */
    private $createdOn;

    /**
     * @var string
     */
    private $updatedOn;

    /**
     * RoleDto Constructor
     *
     * @param string $id
     * @param string $name
     * @param string $identifier
     * @param bool $active
     * @param string $createdOn
     * @param string $updatedOn
     */
    public function __construct($id, $name, $identifier, $active, $createdOn, $updatedOn)
    {
        $this->id = $id;
        $this->name = $name;
        $this->identifier = $identifier;
        $this->active = $active;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @return string
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

    /**
     * @return  string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @return  string
     */
    public function getUpdatedOn(): string
    {
        return $this->updatedOn;
    }
}
