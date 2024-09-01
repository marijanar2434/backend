<?php

namespace App\Common\Infrastructure\Delivery\Symfony\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Messenger\Event\WorkerMessageReceivedEvent;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManagerInterface;

class WorkerMessageReceivedListener implements EventSubscriberInterface
{
    /**
     * @var AuthenticatorManagerInterface
     */
    private $authenticatorManager;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var AuthenticatorInterface
     */
    private $authenticator;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * WorkerMessageReceivedListener Constructor
     *
     * @param AuthenticatorManagerInterface $authenticatorManager
     * @param UserProviderInterface $userProvider
     * @param AuthenticatorInterface $authenticator
     * @param ServerConfiguration $serverConfiguration
     */
    public function __construct(AuthenticatorManagerInterface $authenticatorManager, UserProviderInterface $userProvider, AuthenticatorInterface $authenticator, ServerConfiguration $serverConfiguration)
    {
        $this->authenticatorManager = $authenticatorManager;
        $this->userProvider = $userProvider;
        $this->authenticator = $authenticator;
        $this->serverConfiguration = $serverConfiguration;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            WorkerMessageReceivedEvent::class => 'onWorkerMessageReceived',
        ];
    }

    /**
     * @param  WorkerMessageReceivedEvent $event
     * 
     * @return void
     */
    public function onWorkerMessageReceived(WorkerMessageReceivedEvent $event): void
    {
        if (!$this->authenticatorManager instanceof AuthenticatorManager) {
            return;
        }

        $this->authenticatorManager->authenticateUser(
            $this->userProvider->loadUserByIdentifier('system'),
            $this->authenticator,
            Request::create(
                $this->serverConfiguration->generateUrlByRouteName('api_mes_me_collection')
            )
        );
    }
}
