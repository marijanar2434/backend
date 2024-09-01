<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity;

use App\Common\Application\Dto\Dto;

class UserDto extends Dto
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string|null
     */
    private $avatar;

    /**
     * @var string
     */
    private $createdOn;

    /**
     * @var string
     */
    private $updatedOn;

    /**
     * UserDto Constructor
     *
     * @param string $id
     * @param string $fullName
     * @param string $username
     * @param string $email
     * @param bool $active
     * @param string $avatar
     * @param string $createdOn
     * @param string $updatedOn
     */
    public function __construct($id, $fullName, $username, $email, $active, $avatar, $createdOn, $updatedOn)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->username = $username;
        $this->email = $email;
        $this->active = $active;
        $this->avatar = $avatar;
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
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return  string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return  string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return boolean
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @return  string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
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
