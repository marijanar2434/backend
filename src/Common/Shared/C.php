<?php

namespace App\Common\Shared;

class C
{
    /**
     * @param Object|string $class
     * 
     * @return string
     */
    public static function className($class): string
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }

    /**
     * @param string $class
     * 
     * @return string
     */
    public static function CamelCaseToDot($class): string
    {
        return strtolower(preg_replace('/[A-Z]/', '.\\0', lcfirst($class)));
    }
}
