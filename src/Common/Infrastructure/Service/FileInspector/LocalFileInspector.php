<?php

namespace App\Common\Infrastructure\Service\FileInspector;

use App\Common\Infrastructure\Service\FileInspector\FileInspector;

class LocalFileInspector implements FileInspector
{
    /**
     * @inheritDoc
     */
    public function getName($path): string
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * @inheritDoc
     */
    public function getMimeType($path): ?string
    {
        $mymeType = @finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);

        return $mymeType ? $mymeType : null;
    }

    /**
     * @inheritDoc
     */
    public function getExtension($path): ?string
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return empty($extension) ? null : $extension;
    }

    /**
     * @inheritDoc
     */
    public function getSize($path): ?int
    {
        $size = @filesize($path);

        return $size ? $size : null;
    }

    /**
     * @inheritDoc
     */
    public function getContents($path): ?string
    {
        return \file_get_contents($path);
    }
}
