<?php

namespace App\Common\Shared;

trait InteractsWithConstants
{
    /**
     * @var array|null
     */
    protected static $_constCacheArray = NULL;

    /**
     * @return array
     */
    protected static function _getConstants(): array
    {
        if (self::$_constCacheArray == NULL) {
            self::$_constCacheArray = [];
        }

        $calledClass = \get_called_class();

        if (!\array_key_exists($calledClass, self::$_constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$_constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$_constCacheArray[$calledClass];
    }

    /**
     * @param int|string $value
     * 
     * @return boolean
     */
    protected static function _isValidConstantValue($value): bool
    {
        $values = \array_values(self::_getConstants());

        return \in_array($value, $values, true);
    }
}
