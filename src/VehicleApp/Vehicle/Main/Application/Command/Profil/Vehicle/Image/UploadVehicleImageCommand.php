<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UploadVehicleImageCommand extends Command implements TransactionalCommand, RequiresAuthorization
{
    /**
     * @var string
     */
    private $filePathName;

    /**
     * UploadUserAvatarCommand Constructor
     * 
     * @param string $filePathName
     */
    public function __construct($filePathName)
    {
        $this->filePathName = $filePathName;
    }

    /**
     * @return  string
     */
    public function getFilePathName(): string
    {
        return $this->filePathName;
    }
}

