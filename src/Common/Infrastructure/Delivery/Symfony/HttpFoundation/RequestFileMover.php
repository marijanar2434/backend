<?php

namespace App\Common\Infrastructure\Delivery\Symfony\HttpFoundation;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;

class RequestFileMover
{
    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * RequestFileMover Constructor
     *
     * @param ServerConfiguration $serverConfiguration
     */
    public function __construct(ServerConfiguration $serverConfiguration)
    {
        $this->serverConfiguration = $serverConfiguration;
    }

    /**
     * @param UploadedFile $file
     * 
     * @return File
     */
    public function move(UploadedFile $file): File
    {
        $slugger = new AsciiSlugger();
        $name = $slugger->slug(\pathinfo($file->getClientOriginalName(), \PATHINFO_FILENAME));

        /**
         * Here we make random folder name with Uuid, just because we use client file name
         */
        $folder = sprintf('%s/%s', $this->serverConfiguration->getEnv('APP_TMP_FOLDER'), Uuid::uuid6()->toString());

        $extension = empty($file->getClientOriginalExtension()) ? $file->guessExtension() : $file->getClientOriginalExtension();

        return $file->move(
            $folder,
            empty($extension) ? $name : sprintf('%s.%s', $name, $extension)
        );
    }
}
