<?php

namespace App\Common\Infrastructure\Delivery\Symfony\EventListener;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\MakerBundle\Command\MakerCommand;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Doctrine\Migrations\Tools\Console\Command\DoctrineCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use App\Common\Infrastructure\Service\ServerConfiguration\ServerConfiguration;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManagerInterface;

class OnCommandListener implements EventSubscriberInterface
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
     * OnCommandListener Constructor
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
            ConsoleEvents::COMMAND => 'onCommand',
        ];
    }

    /**
     * @param ConsoleCommandEvent $event
     * 
     * @return void
     */
    public function onCommand(ConsoleCommandEvent $event): void
    {
        if (!$this->authenticatorManager instanceof AuthenticatorManager) {
            return;
        }

        if (\str_contains(\get_class($event->getCommand()), 'Symfony\\Bundle\\FrameworkBundle\\Command\\')) {
            return;
        }

        if ($event->getCommand() instanceof MakerCommand || $event->getCommand() instanceof DoctrineCommand) {
            return;
        }

        try {
            $this->authenticatorManager->authenticateUser(
                $this->userProvider->loadUserByIdentifier('system'),
                $this->authenticator,
                Request::create(
                    $this->serverConfiguration->generateUrlByRouteName('api_mes_me_collection')
                )
            );
        } catch (UserNotFoundException) {
            $io = new SymfonyStyle($event->getInput(), $event->getOutput());
            $io->warning(
                'On Command Event : Authentication manager failed. Reason: User not found.'
            );
        } catch (\Exception $e) {
            $io = new SymfonyStyle($event->getInput(), $event->getOutput());
            $io->warning(
                sprintf('On Command Event : Authentication manager failed. Reason: %s', $e->getMessage())
            );
        }
    }
}
