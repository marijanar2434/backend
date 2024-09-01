<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle;

use App\Common\Application\Dto\Dto;

class VehicleImageDto extends Dto
{
    /**
     * @var string
     */
    private $url;

    /**
     * VehicleImageDto Constructor
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return  string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return  string
     */
    public function getPathInfo(): string
    {
        return  \pathinfo($this->url, \PATHINFO_ALL);
    }
}