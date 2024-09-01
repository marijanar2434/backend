<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class CreateUserCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string|null
     */
    private $avatar;


    /**
     * CreateUserCommand Constructor
     *
     * @param string $id
     * @param string $fullName
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $active
     * @param string|null $avatar
     */
    public function __construct($id, $fullName, $username, $email, $password, $active = true, $avatar = null)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
        $this->avatar = $avatar;
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
     * @return  string
     */
    public function getPassword(): string
    {
        return $this->password;
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
}
