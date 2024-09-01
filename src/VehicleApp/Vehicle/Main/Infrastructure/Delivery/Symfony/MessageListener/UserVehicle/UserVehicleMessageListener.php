<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\MessageListener\UserVehicle;

use App\Common\Application\Bus\CommandBus;
use App\VehicleApp\IdentityAccess\Main\Domain\Event\UserCreated;
use App\VehicleApp\Vehicle\Main\Application\Command\UserVehicle\CreateUserVehicleCommand;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class UserVehicleMessageListener implements MessageSubscriberInterface
{
    /**
     * 
     *
     * @var CommandBus
     */
    private $commandBus;

    /**
     * 
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public static function getHandledMessages(): iterable
    {
        yield UserCreated::class => ['method' => 'onUserCreated'];
    }

    public function onUserCreated(UserCreated $event)
    {
        $this->commandBus->handle(new CreateUserVehicleCommand($event->getEntityId()->getId(), $event->getFullName()));
    }
}
