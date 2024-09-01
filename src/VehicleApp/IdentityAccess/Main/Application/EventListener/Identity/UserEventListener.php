<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\EventListener\Identity;

use App\Common\Application\Bus\CommandBus;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserPasswordResetRequested;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Identity\SendPasswordResetEmailToUserCommand;

class UserEventListener implements MessageSubscriberInterface
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * UserEventListener Constructor
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield UserPasswordResetRequested::class => [
            'method' => 'onUserPasswordResetRequested',
        ];
    }

    /**
     * @param UserPasswordResetRequested $event
     * 
     * @return void
     */
    public function onUserPasswordResetRequested(UserPasswordResetRequested $event): void
    {
        $this->commandBus->handle(
            new SendPasswordResetEmailToUserCommand(
                $event->getEntityId()->getId()
            )
        );
    }
}
