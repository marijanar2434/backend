<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Security;

use Nyholm\Psr7\Factory\Psr17Factory;
use League\OAuth2\Server\ResourceServer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class OAuth2Authenticator extends AbstractAuthenticator
{
    /**
     * @var ResourceServer
     */
    private $resourceServer;

    /**
     * OAuth2Authenticator Constructor
     * 
     * @param ResourceServer $resourceServer
     */
    public function __construct(ResourceServer $resourceServer)
    {
        $this->resourceServer = $resourceServer;
    }

    /**
     * @param Request $request
     * 
     * @return boolean
     */
    public function supports(Request $request): bool
    {
        return true;
    }

    /**
     * @param Request $request
     * 
     * @return Passport
     */
    public function authenticate(Request $request): Passport
    {
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        try {
            $resourceServerRequest = $this->resourceServer->validateAuthenticatedRequest(
                $psrHttpFactory->createRequest(
                    $request->duplicate()
                )
            );
        } catch (OAuthServerException $e) {
            throw new CustomUserMessageAuthenticationException(
                $e->getMessage(),
                [],
                $e->getCode(),
                $e
            );
        }

        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyRequest = $httpFoundationFactory->createRequest($resourceServerRequest);

        return new SelfValidatingPassport(new UserBadge($symfonyRequest->get('oauth_user_id')));
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * 
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * 
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'title' => 'An error occurred',
            'detail' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}
