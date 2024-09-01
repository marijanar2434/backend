<?php

namespace App\Common\Domain\Validator;


abstract class Validator
{
    /**
     * @return ValidationNotificationHandler
     */
    public abstract function validate($object): ValidationNotificationHandler;
}
