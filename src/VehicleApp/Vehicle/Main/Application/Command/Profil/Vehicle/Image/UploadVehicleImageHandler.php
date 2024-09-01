<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image;

use Ramsey\Uuid\Uuid;
use App\Common\Application\Command\CommandHandler;
use App\Common\Application\Transformer\ItemTransformer;
use App\Common\Infrastructure\Service\FileUploader\FileUploader;
use App\Common\Infrastructure\Service\FileDestroyer\FileDestroyer;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\Image\UploadVehicleImageCommand;

class UploadVehicleImageHandler implements CommandHandler
{
    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @var FileDestroyer
     */
    private $fileDestroyer;

    /**
     * @var FileInspector
     */
    private $fileInspector;

    /**
     * @var ItemTransformer
     */
    private $itemTransformer;

    /**
     * UploadUserAvatarHandler constructor
     *
     * @param ServerConfiguration $serverConfiguration
     * @param FileUploader $fileUploader
     * @param FileDestroyer $fileDestroyer
     * @param ItemTransformer $itemTransformer
     */
    public function __construct(ServerConfiguration $serverConfiguration, FileUploader $fileUploader, FileDestroyer $fileDestroyer, FileInspector $fileInspector, ItemTransformer $itemTransformer)
    {
        $this->serverConfiguration = $serverConfiguration;
        $this->fileUploader = $fileUploader;
        $this->fileDestroyer = $fileDestroyer;
        $this->fileInspector = $fileInspector;
        $this->itemTransformer = $itemTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UploadVehicleImageCommand  $command)
    {
        $path = sprintf(
            '/vehicles/vehicles/images/%s/%s.%s',
            Uuid::uuid6()->toString(),
            $this->fileInspector->getName($command->getFilePathName()),
            $this->fileInspector->getExtension($command->getFilePathName())
        );

        $url = $this->fileUploader->upload(
            $path,
            $command->getFilePathName()
        );

        $this->fileDestroyer->destroy($command->getFilePathName());

        $this->itemTransformer->write(
            $this->serverConfiguration->generateUrl(
                sprintf('/upload%s', $path)
            )
        );

        return $this->itemTransformer->read();
    }
}
