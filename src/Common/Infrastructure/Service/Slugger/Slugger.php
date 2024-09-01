<?php

namespace App\Common\Infrastructure\Service\Slugger;

interface Slugger
{
    /**
     * @param string $string
     * 
     * @return string
     */
    public function slug(string $string): string;
}
