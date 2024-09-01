<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity;

use App\Common\Application\Dto\Dto;

class UserAvatarDto extends Dto
{
    /**
     * @var string
     */
    private $url;

    /**
     * UserAvatarDto Constructor
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
