<?php

namespace App\Common\Infrastructure\Service\Slugger;

use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Common\Infrastructure\Service\Slugger\Slugger;

class SymfonySlugger implements Slugger
{
    /**
     * @var AsciiSlugger
     */
    private $slugger;

    /**
     * SymfonySlugger Constructor
     */
    public function __construct()
    {
        $this->slugger = new AsciiSlugger('en', [
            'en' => [
                '&' => 'and'
            ]
        ]);
    }

    /**
     * @param string $string
     * 
     * @return string
     */
    public function slug(string $string): string
    {
        return $this->slugger
            ->slug($string)
            ->lower()
            ->toString();
    }
}
