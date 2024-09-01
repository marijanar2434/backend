<?php

namespace App\Common\Infrastructure\Service\FileDestroyer;

interface FileDestroyer
{
    /**
     * @param string $path - full path where to upload together with filename and extenstion
     *
     * @return boolean
     */
    public function destroy($path): bool;
}
