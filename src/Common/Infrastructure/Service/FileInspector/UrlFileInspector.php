<?php

namespace App\Common\Infrastructure\Service\FileInspector;

use App\Common\Shared\Array\Arr;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Common\Infrastructure\Service\FileInspector\FileInspector;

class UrlFileInspector implements FileInspector
{
    /**
     * @var array
     */
    private $cache;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * UrlFileInspector Constructor
     *
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $path
     * 
     * @return array|null
     */
    private function makeRequest($path): ?array
    {
        if (!empty($this->cache[$path])) {
            return $this->cache[$path];
        }

        $response = $this->httpClient->request('GET', $path);

        if (200 !== $response->getStatusCode()) {
            return null;
        }

        $chunkOfTheFile = fopen('php://temp', 'r+');
        $streamedTimes = 0;
        foreach ($this->httpClient->stream($response) as $chunk) {
            fwrite($chunkOfTheFile, $chunk->getContent());
            $streamedTimes++;
            if ($streamedTimes >= 2) {
                break;
            }
        }
        $response->cancel();
        rewind($chunkOfTheFile);

        return $this->cache[$path] = [
            'headers' => Arr::map($response->getHeaders(false), fn ($value, $key) => Arr::first($value)),
            'content' => $chunkOfTheFile
        ];
    }

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
        $response = $this->makeRequest($path);

        if (!isset($response['content'])) {
            return null;
        }

        return @mime_content_type(
            $response['content']
        );
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
        $response = $this->makeRequest($path);
        if (isset($response['headers']['content-length'])) {
            return intval($response['headers']['content-length']);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getContents($path): ?string
    {
        $response = $this->httpClient->request('GET', $path);

        return $response->getContent(false);
    }
}
