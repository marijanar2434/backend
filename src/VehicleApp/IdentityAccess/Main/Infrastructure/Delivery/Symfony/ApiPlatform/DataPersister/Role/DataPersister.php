<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Role;

use App\Common\Application\Bus\CommandBus;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Access\CreateRoleCommand;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Access\UpdateRoleCommand;
use App\VehicleApp\IdentityAccess\Main\Application\Command\Access\DestroyRoleCommand;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Role\Role;

class DataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * DataPersister Constructor
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = new ExceptionHandlingCommandBus($commandBus, new ExceptionHandler);
    }

    /**
     * @param mixed $data
     * @param array $context
     * 
     * @return boolean
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Role;
    }

    /**
     * @param Role $data
     * @param array $context
     * 
     * @return mixed
     */
    public function persist($data, array $context = []): mixed
    {
        if ($this->isCreateOperation($context)) {
            $this->commandBus->handle(new CreateRoleCommand(
                $data->id,
                $data->name,
                $data->identifier,
                $data->active,
            ));
        }

        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateRoleCommand(
                $data->id,
                $data->name,
                $data->identifier,
                $data->active,
            ));
        }

        // call your persistence layer to save $data
        return $data;
    }

    /**
     * @param Role $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {
        $this->commandBus->handle(new DestroyRoleCommand(
            $data->id
        ));
    }

    /**
     * @param array $context
     * 
     * @return boolean
     */
    private function isCreateOperation($context): bool
    {
        return ($context['collection_operation_name'] ?? null) === 'post' || ($context['graphql_operation_name'] ?? null) === 'create';
    }

    /**
     * @param array $context
     * 
     * @return boolean
     */
    private function isUpdateOperation($context): bool
    {
        return in_array(($context['item_operation_name'] ?? ''), ['put', 'patch'], true) || ($context['graphql_operation_name'] ?? null) === 'update';
    }
}
