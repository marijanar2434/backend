<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Identity;

use Assert\Assert;
use DateTimeImmutable;
use App\Common\Domain\Entity;
use App\Common\Shared\Array\Arr;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\ValueObject\File;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use Doctrine\Common\Collections\ArrayCollection;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserCreated;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserUpdated;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Access\Role;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserPasswordReseted;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserPasswordResetRequested;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\SystemUserCannotBeModified;
use App\VehicleApp\IdentityAccess\Main\Domain\Exception\UserDidNotRequestedPasswordReset;

class User extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

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
     * @var PasswordResetRequest|null
     */
    private $passwordResetRequest;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var File|null
     */
    private $avatar;

    /**
     * @var ArrayCollection<Role>
     */
    private $roles;

    /**
     * User Constructor
     *
     * @param Id $id
     * @param string $fullName
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $active
     * @param File $avatar
     * @param array $roles
     */
    public function __construct(Id $id, string $fullName, string $username, string $email, string $password, bool $active, File $avatar = null, array $roles = [])
    {
        parent::__construct($id);

        $this->setFullName($fullName);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setActive($active);
        $this->setAvatar($avatar);
        $this->setRoles($roles);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new UserCreated(
            $id,
            $fullName,
            $username,
            $email,
            empty($avatar) ? '' : $avatar->getFile()
        ));
    }

    /**
     * @return array
     */
    public static function getSystemUsers(): array
    {
        return [
            [
                'username' => 'system',
                'email' => 'system@dev-vehicle.com',
            ],
            [
                'username' => 'admin',
                'email' => 'admin@dev-vehicle.com',
            ]
        ];
    }

    /**
     * @return boolean
     */
    public function isSystemUser(): bool
    {
        return in_array($this->getUsername(), Arr::pluck(self::getSystemUsers(), 'username'), true) ||
            in_array($this->getEmail(), Arr::pluck(self::getSystemUsers(), 'email'), true);
    }

    /**
     * @return  string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     *
     * @return  self
     */
    private function setFullName(string $fullName): self
    {
        Assert::that($fullName)
            ->notEmpty();

        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return  string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return  self
     */
    private function setUsername(string $username): self
    {
        Assert::that($username)
            ->notEmpty();

        $this->username = $username;

        return $this;
    }

    /**
     * @return  string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return  self
     */
    private function setEmail(string $email): self
    {
        Assert::that($email)
            ->notEmpty()
            ->email();

        $this->email = $email;

        return $this;
    }

    /**
     * @return  string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return  self
     */
    private function setPassword(string $password): self
    {
        Assert::that($password)
            ->notEmpty();

        $this->password = $password;

        return $this;
    }

    /**
     * @return  PasswordResetRequest
     */
    public function getPasswordResetRequest(): PasswordResetRequest
    {
        return $this->passwordResetRequest;
    }

    /**
     * @param  PasswordResetRequest  $passwordResetRequest
     *
     * @return  self
     */
    private function setPasswordResetRequest(?PasswordResetRequest $passwordResetRequest): self
    {
        $this->passwordResetRequest = $passwordResetRequest;

        return $this;
    }

    /**
     * @return void
     */
    public function requestPasswordReset(): void
    {
        if (!$this->isActive()) {
            return;
        }

        $this->setPasswordResetRequest(new PasswordResetRequest());

        $this->recordThat(new UserPasswordResetRequested($this->id));
    }

    /**
     * @return void
     */
    public function passwordReset($passwordResetRequestId, string $password): void
    {
        if (!$this->hasRequestedPasswordReset()) {
            throw new UserDidNotRequestedPasswordReset();
        }

        if (!$this->passwordResetRequest->equals(new PasswordResetRequest($passwordResetRequestId))) {
            throw new UserDidNotRequestedPasswordReset();
        }

        $this->setPasswordResetRequest(null);
        $this->setPassword($password);

        $this->recordThat(new UserPasswordReseted($this->id));
    }

    /**
     * @return boolean
     */
    public function hasRequestedPasswordReset(): bool
    {
        return !empty($this->passwordResetRequest) && !empty($this->passwordResetRequest->getId());
    }

    /**
     * @return boolean
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return  self
     */
    private function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return  File|null
     */
    public function getAvatar(): ?File
    {
        return $this->avatar !== null ? ($this->avatar)() : null;
    }

    /**
     * @param File $avatar
     *
     * @return  self
     */
    private function setAvatar(?File $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return  Role[]
     */
    public function getRoles($offset = null, $length = null): array
    {
        if (\is_null($offset)) {
            return $this->roles->toArray();
        }

        return $this->roles->slice($offset, $length);
    }

    /**
     * @param  Role[]  $roles
     *
     * @return  self
     */
    private function setRoles(array $roles): self
    {
        $this->roles = new ArrayCollection($roles);

        return $this;
    }

    /**
     * @param Role $role
     * 
     * @return  void
     */
    public function attachRole(Role $role): void
    {
        foreach ($this->roles as $r) {
            if ($r->getId()->equals($role->getId())) {
                return;
            }
        }

        $this->roles[] = $role;
    }

    /**
     * @param Role $role
     * 
     * @return  void
     */
    public function detachRole(Role $role): void
    {
        foreach ($this->roles as $key => $r) {
            if ($r->getId()->equals($role->getId())) {
                unset($this->roles[$key]);
                return;
            }
        }
    }

    /**
     * @return void
     */
    public function detachAllRoles(): void
    {
        foreach ($this->roles as $r) {
            $this->detachRole($r);
        }
    }

    /**
     * @param Role $role
     * 
     * @return boolean
     */
    public function hasRole(Role $role): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getIdentifier() === $role->getIdentifier()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $roleIdentifier
     * 
     * @return boolean
     */
    public function hasRoleWithIdentifier(string $roleIdentifier): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getIdentifier() === $roleIdentifier) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function getRoleCount(): int
    {
        return $this->roles->count();
    }

    /**
     * @return  string
     */
    public function getDefaultRoleIdentifier(): string
    {
        return 'ROLE_USER';
    }

    /**
     * @param string $fullName
     * @param string $username
     * @param string $email
     * @param string $password
     * @param bool $active
     * @param File $avatar
     * 
     * @return void
     */
    public function updateProperties(string $fullName, string $username, string $email, string $password, bool $active, ?File $avatar): void
    {
        if ($this->isSystemUser()) {
            throw new SystemUserCannotBeModified();
        }

        $this->setFullName($fullName);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setActive($active);
        $this->setAvatar($avatar);

        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new UserUpdated(
            $this->id,
            $fullName,
            $username,
            $email,
            empty($avatar) ? '' : $avatar->getFile()
        ));
    }
}
