<?php

namespace App\Common\Infrastructure\Service\FileUploader;

interface FileUploader
{
    /**
     * @param string $path - full path where to upload together with filename and extenstion
     * @param resource|string $contents
     *
     * @return string
     */
    public function upload($path, $contents): string;
}
