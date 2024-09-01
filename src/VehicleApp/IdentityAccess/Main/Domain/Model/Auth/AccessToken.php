<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Entity;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AccessTokenIssued;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\AccessTokenRevoked;

class AccessToken extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var Id
     */
    private $userId;

    /**
     * @var Id
     */
    private $clientId;

    /**
     * @var array
     */
    private $scopes;

    /**
     * @var boolean
     */
    private $revoked;

    /**
     * @var DateTimeImmutable
     */
    private $expiresOn;

    /**
     * AccessToken Constructor
     *
     * @param Id $id
     * @param string $identifier
     * @param Id $userId
     * @param Id $clientId
     * @param array $scopes
     * @param bool $revoked
     * @param DateTimeImmutable $expiresOn
     */
    public function __construct(Id $id, string $identifier, Id $userId, Id $clientId, array $scopes, bool $revoked, DateTimeImmutable $expiresOn)
    {
        parent::__construct($id);

        $this->setIdentifier($identifier);
        $this->setUserId($userId);
        $this->setClientId($clientId);
        $this->setScopes($scopes);
        $this->setRevoked($revoked);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
        $this->setExpiresOn($expiresOn);

        $this->recordThat(new AccessTokenIssued($id));
    }

    /**
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     *
     * @return  self
     */
    private function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return  Id
     */
    public function getUserId(): Id
    {
        return $this->userId;
    }

    /**
     * @param Id $userId
     *
     * @return  self
     */
    private function setUserId(Id $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return  Id
     */
    public function getClientId(): Id
    {
        return $this->clientId;
    }

    /**
     * @param Id $clientId
     *
     * @return  self
     */
    private function setClientId(Id $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return  array
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     *
     * @return  self
     */
    private function setScopes(array $scopes): self
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @param bool $revoked
     *
     * @return  self
     */
    private function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;

        return $this;
    }

    /**
     * @return  DateTimeImmutable
     */
    public function getExpiresOn(): DateTimeImmutable
    {
        return $this->expiresOn;
    }

    /**
     * @param  DateTimeImmutable  $expiresOn
     *
     * @return  self
     */
    private function setExpiresOn(DateTimeImmutable $expiresOn): self
    {
        $this->expiresOn = $expiresOn;

        return $this;
    }

    /**
     * @return self
     */
    public function revoke(): self
    {
        $this->revoked = true;
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new AccessTokenRevoked($this->id));

        return $this;
    }
}
