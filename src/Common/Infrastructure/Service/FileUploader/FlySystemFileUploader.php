<?php

namespace App\Common\Infrastructure\Service\FileUploader;

use App\Common\Shared\Url\Url;
use League\Flysystem\Filesystem;

class FlySystemFileUploader implements FileUploader
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $location;

    /**
     * FlySystemFileUploader Constructor
     *
     * @param Filesystem $filesystem
     * @param string $location
     */
    public function __construct(Filesystem $filesystem, string $location)
    {
        $this->filesystem = $filesystem;
        $this->location = $location;
    }

    /**
     * @inheritDoc
     */
    public function upload($path, $contents): string
    {
        $this->filesystem->writeStream(
            $path,
            $this->toStream($contents)
        );

        return $this->location . $path;
    }

    /**
     * @param mixed $var
     * 
     * @return resource
     */
    private function toStream($var)
    {
        if (\is_resource($var)) {
            return $var;
        }

        if (Url::isValid($var) || @file_exists($var)) {
            return fopen($var, 'r');
        }

        $resource = fopen('php://temp', 'r+');
        fwrite($resource, (string)$var);
        rewind($resource);

        return $resource;
    }
}
