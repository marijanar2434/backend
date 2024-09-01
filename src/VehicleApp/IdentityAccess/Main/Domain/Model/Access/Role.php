<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Access;

use DateTimeImmutable;
use App\Common\Domain\Entity;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use Doctrine\Common\Collections\ArrayCollection;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\RoleCreated;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\RoleUpdated;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity\User;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemRoleCannotBeModified;

class Role extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

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
     * @var ArrayCollection<User>
     */
    private $users;

    /**
     * Role Constructor
     *
     * @param Id $id
     * @param string $name
     * @param string $identifier
     * @param bool $active
     */
    public function __construct(Id $id, string $name, string $identifier, bool $active)
    {
        parent::__construct($id);

        $this->setName($name);
        $this->setIdentifier($identifier);
        $this->setActive($active);
        $this->setUsers([]);

        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new RoleCreated($id));
    }

    /**
     * @return string[]
     */
    public static function getSystemRoles(): array
    {
        return [
            'ROLE_USER',
            'ROLE_ADMIN',
            'ROLE_SYSTEM'
        ];
    }

    /**
     * @return boolean
     */
    public function isSystemRole(): bool
    {
        return in_array($this->getIdentifier(), self::getSystemRoles(), true);
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return  self
     */
    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param  string  $identifier
     *
     * @return  self
     */
    private function setIdentifier(string $identifier): self
    {
        $this->identifier = \str_replace(' ', '_', \strtoupper(\trim($identifier)));

        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param  bool  $active
     *
     * @return  self
     */
    private function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return  User[]
     */
    public function getUsers(): array
    {
        return $this->users->toArray();
    }

    /**
     * @param  User[]  $users
     *
     * @return  self
     */
    private function setUsers(array $users): self
    {
        $this->users = new ArrayCollection($users);

        return $this;
    }

    /**
     * @param string $name
     * @param string $identifier
     * @param boolean $active
     * 
     * @return void
     */
    public function updateProperties(string $name, string $identifier, bool $active): void
    {
        if ($this->isSystemRole()) {
            throw new SystemRoleCannotBeModified();
        }

        $this->setName($name);
        $this->setIdentifier($identifier);
        $this->setActive($active);

        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new RoleUpdated($this->id));
    }
}
