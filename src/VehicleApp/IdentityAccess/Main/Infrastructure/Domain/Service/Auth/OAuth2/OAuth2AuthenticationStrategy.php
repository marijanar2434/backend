<?php


namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Domain\Service\Auth\OAuth2;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\AuthorizationServer;
use Symfony\Component\HttpFoundation\Request;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use App\VehicleApp\IdentityAccess\Main\Domain\Model\Auth\ClientRepository;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationRequest;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationResponse;
use App\VehicleApp\IdentityAccess\Main\Domain\Service\Auth\AuthenticationStrategy;

class OAuth2AuthenticationStrategy implements AuthenticationStrategy
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * @var AuthorizationServer
     */
    private $authorizationServer;

    /**
     * OAuth2Authentication Constructor
     *
     * @param ClientRepository $clientRepository
     * @param ServerConfiguration $serverConfiguration
     * @param AuthorizationServer $authorizationServer
     */
    public function __construct(ClientRepository $clientRepository, ServerConfiguration $serverConfiguration, AuthorizationServer $authorizationServer)
    {
        $this->clientRepository = $clientRepository;
        $this->serverConfiguration = $serverConfiguration;
        $this->authorizationServer = $authorizationServer;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(AuthenticationRequest $authenticationRequest): AuthenticationResponse
    {
        $response = null;

        try {
            $response = $this
                ->authorizationServer
                ->respondToAccessTokenRequest(
                    $this->makeAccessTokenRequest(
                        $authenticationRequest->getIdentity(),
                        $authenticationRequest->getPassword()
                    ),
                    new Psr7Response()
                );
        } catch (OAuthServerException $e) {
            $response = $e->generateHttpResponse(new Psr7Response());
        }

        return $this->translateAuthorizationServerResponse($response);
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $scope
     *
     * @return ServerRequestInterface
     */
    private function makeAccessTokenRequest($username, $password, $scope = '*')
    {
        $client = $this->clientRepository->findByGeneralPurposeAuthentication();

        if (empty($client)) {
            throw new \Exception('Cannot make access token request. General purpose authentication client not found.');
        }

        $postData = [
            'grant_type' => 'password',
            'client_id' => $client->getId()->getId(),
            'client_secret' => $this->serverConfiguration->getAppSecret(),
            'scope' => $scope,
            'username' => $username,
            'password' => $password
        ];

        $server = [
            'HTTP_HOST' => $this->serverConfiguration->getEnv('APP_HOSTNAME'),
            'HTTP_CACHE_CONTROL' => 'no-cache',
            'HTTP_USER_AGENT' => 'PostmanRuntime/7.26.8',
            'HTTP_ACCEPT' => 'application/json',
            'SCRIPT_FILENAME' => '/var/www/html/public/index.php',
            'PATH_TRANSLATED' => '/var/www/html/public',
            'PATH_INFO' => '',
            'REQUEST_SCHEME' => $this->serverConfiguration->getScheme(),
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'DOCUMENT_ROOT' => '/var/www/html/public',
            'DOCUMENT_URI' => '/index.php',
            'REQUEST_URI' => '/oauth2/access_token',
            'SCRIPT_NAME' => '/index.php',
            'CONTENT_TYPE' => 'multipart/form-data; boundary=--------------------------103980797895047227460316',
            'REQUEST_METHOD' => 'POST',
            'QUERY_STRING' => '',
            'PHP_SELF' => '/index.php',
        ];

        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $symfonyRequest = new Request([], $postData, [], [], [], $server);

        return $psrHttpFactory->createRequest($symfonyRequest);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return AuthenticationResponse
     */
    private function translateAuthorizationServerResponse($response)
    {
        if (empty($response)) {
            throw new \Exception('Cannot translate authorization server response. Response is empty.');
        }

        $responseBody = (string)$response->getBody();
        $jsonDecodedResponseBody = json_decode($responseBody, true);

        if ($response->getStatusCode() === 200) {
            return new AuthenticationResponse(
                true,
                'Successfully authenticated.',
                [
                    'tokenType' =>  $jsonDecodedResponseBody['token_type'] ?? 'Bearer',
                    'expiresIn' =>  $jsonDecodedResponseBody['expires_in'],
                    'accessToken' => $jsonDecodedResponseBody['access_token'],
                    'refresh_token' => $jsonDecodedResponseBody['refresh_token'] ?? null,
                ]
            );
        }

        return new AuthenticationResponse(false, $jsonDecodedResponseBody['message'] ?? 'Invalid access token request.');
    }
}
