<?php

namespace App\Common\Infrastructure\Persistence\Doctrine\Types;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidType;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use App\Common\Domain\ValueObject\Id as IdValueObject;

class Id extends UuidType
{
    /**
     * @var string
     */
    const name = 'uuid';

    /**
     * @var string
     */
    const className = IdValueObject::class;

    /**
     * @inheritDoc
     *
     * @param string|UuidInterface|null $value
     * @param AbstractPlatform $platform
     *
     * @return IdValueObject|null
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IdValueObject
    {
        $className = self::className;

        if (empty($value)) {
            return null;
        }

        return new $className($value);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::name;
    }
}
