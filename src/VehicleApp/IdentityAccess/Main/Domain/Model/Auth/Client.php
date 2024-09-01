<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth;

use DateTimeImmutable;
use App\Common\Domain\ValueObject\Id;
use App\Common\Domain\Entity;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\RecordingDomainEvents;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\ClientCreated;

class Client extends Entity implements RecordingDomainEvents
{
    use DateTimeTracking, DomainEventRecording;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var boolean
     */
    private $confidential;

    /**
     * @var boolean
     */
    private $usedForGeneralPurposeAuthentication;

    /**
     * Client Constructor
     *
     * @param Id $id
     * @param string $name
     * @param string $secret
     * @param string $redirectUri
     * @param bool $active
     * @param bool $confidential
     * @param bool $usedForGeneralPurposeAuthentication
     */
    public function __construct(Id $id, string $name, string $secret, string $redirectUri, bool $active, bool $confidential, bool $usedForGeneralPurposeAuthentication = false)
    {
        parent::__construct($id);

        $this->setName($name);
        $this->setSecret($secret);
        $this->setRedirectUri($redirectUri);
        $this->setActive($active);
        $this->setConfidential($confidential);
        $this->setUsedForGeneralPurposeAuthentication($usedForGeneralPurposeAuthentication);
        $this->setCreatedOn(new DateTimeImmutable());
        $this->setUpdatedOn(new DateTimeImmutable());

        $this->recordThat(new ClientCreated($id));
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
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
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     *
     * @return  self
     */
    private function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * @return  string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     *
     * @return  self
     */
    private function setRedirectUri(string $redirectUri): self
    {
        $this->redirectUri = $redirectUri;

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
    public function getConfidential(): bool
    {
        return $this->confidential;
    }

    /**
     * @param  bool  $confidential
     *
     * @return  self
     */
    private function setConfidential(bool $confidential): self
    {
        $this->confidential = $confidential;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getUsedForGeneralPurposeAuthentication(): bool
    {
        return $this->usedForGeneralPurposeAuthentication;
    }

    /**
     * @param  bool  $usedForGeneralPurposeAuthentication
     *
     * @return  self
     */
    private function setUsedForGeneralPurposeAuthentication($usedForGeneralPurposeAuthentication): self
    {
        $this->usedForGeneralPurposeAuthentication = $usedForGeneralPurposeAuthentication;

        return $this;
    }
}
