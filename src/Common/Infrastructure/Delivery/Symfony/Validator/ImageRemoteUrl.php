<?php

namespace App\Common\Infrastructure\Delivery\Symfony\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute]
class ImageRemoteUrl extends Constraint
{
    /**
     * @var string
     */
    public $message = 'This URL does not point to a valid image file.';

    /**
     * @inheritDoc
     */
    public function getTargets(): string|array
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
