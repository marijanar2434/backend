<?php

namespace App\Common\Infrastructure\Service\FileInspector;

class CachingUrlFileInspector implements FileInspector
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @var UrlFileInspector
     */
    private $urlFileInspector;

    /**
     * CachingUrlFileInspector Constructor
     *
     * @param UrlFileInspector $urlFileInspector
     */
    public function __construct(UrlFileInspector $urlFileInspector)
    {
        $this->urlFileInspector = $urlFileInspector;
    }

    /**
     * @inheritDoc
     */
    public function getName($path): string
    {
        if (!empty($this->cache[$path]['name'])) {
            return $this->cache[$path]['name'];
        }

        return $this->cache[$path]['name'] = $this->urlFileInspector->getName($path);
    }

    /**
     * @inheritDoc
     */
    public function getMimeType($path): ?string
    {
        if (!empty($this->cache[$path]['mimeType'])) {
            return $this->cache[$path]['mimeType'];
        }

        return $this->cache[$path]['mimeType'] = $this->urlFileInspector->getMimeType($path);
    }

    /**
     * @inheritDoc
     */
    public function getExtension($path): ?string
    {
        if (!empty($this->cache[$path]['extension'])) {
            return $this->cache[$path]['extension'];
        }

        return $this->cache[$path]['extension'] = $this->urlFileInspector->getExtension($path);
    }

    /**
     * @inheritDoc
     */
    public function getSize($path): ?int
    {
        if (!empty($this->cache[$path]['size'])) {
            return $this->cache[$path]['size'];
        }

        return $this->cache[$path]['size'] = $this->urlFileInspector->getSize($path);
    }

    /**
     * @inheritDoc
     */
    public function getContents($path): ?string
    {
        if (!empty($this->cache[$path]['contents'])) {
            return $this->cache[$path]['contents'];
        }

        return $this->cache[$path]['contents'] = $this->urlFileInspector->getContents($path);
    }
}
