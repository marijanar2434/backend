<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Command\Identity;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UploadUserAvatarCommand extends Command implements TransactionalCommand, RequiresAuthorization
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
