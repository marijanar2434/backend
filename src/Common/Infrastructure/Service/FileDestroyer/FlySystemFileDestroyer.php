<?php

namespace App\Common\Infrastructure\Service\FileDestroyer;

class FlySystemFileDestroyer implements FileDestroyer
{
    /**
     * @inheritDoc
     */
    public function destroy($path): bool
    {
        return \unlink($path);
    }
}
