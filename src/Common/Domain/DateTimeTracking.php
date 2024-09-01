<?php

namespace App\Common\Domain;

use DateTimeImmutable;

trait DateTimeTracking
{
    /**
     * @var DateTimeImmutable
     */
    protected $createdOn;

    /**
     * @var DateTimeImmutable
     */
    protected $updatedOn;

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedOn(): DateTimeImmutable
    {
        return $this->createdOn;
    }

    /**
     * @param DateTimeImmutable $createdOn
     *
     * @return self
     */
    protected function setCreatedOn(DateTimeImmutable $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedOn(): DateTimeImmutable
    {
        return $this->updatedOn;
    }

    /**
     * @param DateTimeImmutable $updatedOn
     *
     * @return self
     */
    protected function setUpdatedOn(DateTimeImmutable $updatedOn): self
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }
}
