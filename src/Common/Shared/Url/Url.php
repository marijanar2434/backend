<?php

namespace App\Common\Shared\Url;

class Url
{
    /**
     * @param string $url
     * 
     * @return boolean
     */
    public static function isValid($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * @param string $url
     * 
     * @return string
     */
    public static function getScheme($url): string
    {
        return parse_url($url, PHP_URL_SCHEME);
    }
}
