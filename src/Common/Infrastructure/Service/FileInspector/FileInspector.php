<?php

namespace App\Common\Infrastructure\Service\FileInspector;

interface FileInspector
{
    /**
     * @param string $path
     * 
     * @return string
     */
    public function getName($path): string;

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getMimeType($path): ?string;

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getExtension($path): ?string;

    /**
     * @param string $path
     * 
     * @return int|null
     */
    public function getSize($path): ?int;

    /**
     * @param string $path
     * 
     * @return string|null
     */
    public function getContents($path): ?string;
}
