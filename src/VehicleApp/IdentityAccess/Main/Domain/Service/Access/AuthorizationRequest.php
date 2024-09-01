<?php

namespace App\VehicleApp\IdentityAccess\Main\Domain\Service\Access;

class AuthorizationRequest
{
    /**
     * @var mixed
     */
    private $attribute;

    /**
     * @var mixed
     */
    private $subject;

    /**
     * AuthorizationRequest Constructor
     *
     * @param mixed $attribute
     * @param mixed $subject
     */
    public function __construct(mixed $attribute, mixed $subject)
    {
        $this->attribute = $attribute;
        $this->subject = $subject;
    }

    /**
     * @return  mixed
     */
    public function getAttribute(): mixed
    {
        return $this->attribute;
    }

    /**
     * @return  mixed
     */
    public function getSubject(): mixed
    {
        return $this->subject;
    }
}
