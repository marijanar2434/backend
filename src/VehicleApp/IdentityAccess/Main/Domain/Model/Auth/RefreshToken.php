<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Entity;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\RefreshTokenIssued;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\RefreshTokenRevoked;

class RefreshToken extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $accessTokenIdentifier;

    /**
     * @var boolean
     */
    private $revoked;

    /**
     * @var DateTimeImmutable
     */
    private $expiresOn;

    /**
     * RefreshToken Constructor
     *
     * @param Id $id
     * @param string $identifier
     * @param string $accessTokenIdentifier
     * @param bool $revoked
     * @param DateTimeImmutable $expiresOn
     */
    public function __construct(Id $id, string $identifier, string $accessTokenIdentifier, bool $revoked, DateTimeImmutable $expiresOn)
    {
        parent::__construct($id);

        $this->setIdentifier($identifier);
        $this->setAccessTokenIdentifier($accessTokenIdentifier);
        $this->setRevoked($revoked);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());
        $this->setExpiresOn($expiresOn);

        $this->recordThat(new RefreshTokenIssued($id));
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
     * @return  string
     */
    public function getAccessTokenIdentifier(): string
    {
        return $this->accessTokenIdentifier;
    }

    /**
     * @param string $accessTokenIdentifier
     *
     * @return  self
     */
    private function setAccessTokenIdentifier(string $accessTokenIdentifier): self
    {
        $this->accessTokenIdentifier = $accessTokenIdentifier;

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

        $this->recordThat(new RefreshTokenRevoked($this->id));

        return $this;
    }
}
