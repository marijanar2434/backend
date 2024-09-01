<?php

namespace App\Common\Infrastructure\Service\ServerConfiguration;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ServerConfiguration
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    /**
     * ServerConfiguration Constructor
     *
     * @param RouterInterface $router
     * @param ContainerBagInterface $params
     */
    public function __construct(RouterInterface $router, ContainerBagInterface $params)
    {
        $this->router = $router;
        $this->params = $params;
    }

    /**
     * @param string $name
     * @param array $parameters
     * @param int $referenceType
     * 
     * @return string
     */
    public function generateUrlByRouteName(string $name, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        return sprintf('%s://%s%s', $this->getScheme(), $this->getHostname(), $this->router->generate($name, $parameters, $referenceType));
    }

    /**
     * @param string $uri
     * @param array $parameters
     * 
     * @return string
     */
    public function generateUrl(string $uri, array $parameters = []): string
    {
        return sprintf('%s://%s%s%s', $this->getScheme(), $this->getHostname(), $uri, empty($parameters) ? '' : '?' . http_build_query($parameters));
    }

    /**
     * @return string
     */
    public function getKernelProjectDir(): string
    {
        return $this->params->get('kernel.project_dir');
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $_ENV['APP_SECRET'] ?? null;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $_ENV['APP_HOSTNAME'] ?? null;
    }

    /**
     * @return boolean
     */
    public function isSslEnabled(): bool
    {
        return  filter_var($_ENV['APP_SSL_ENABLED'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->isSslEnabled() ? 'https' : 'http';
    }

    /**
     * @return boolean
     */
    public function isInDebugMode(): bool
    {
        return isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === '1';
    }

    /**
     * @param string $key
     * @param mixed $default
     * 
     * @return mixed
     */
    public function getEnv($key, $default = null): mixed
    {
        return $_ENV[$key] ?? $default;
    }
}
