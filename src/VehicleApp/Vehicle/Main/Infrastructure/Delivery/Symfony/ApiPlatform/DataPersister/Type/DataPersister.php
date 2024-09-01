<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Type;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Type\CreateTypeCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Type\DestroyTypeCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Type\UpdateTypeCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

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
        
        return $data instanceof Type;
    }

    /**
     * 
     *
     * @param Type $data
     * @param array $context
     * 
     * @return mixed
     */
    public function persist($data, array $context = [])
    {
        if ($this->isCreateOperation($context)) {       
            $this->commandBus->handle(new CreateTypeCommand(
                $data->id,
                $data->name,
                $data->brand
            )); 
        }

       
        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateTypeCommand(
                $data->id,
                $data->name,
                $data->brand
            ));
        }

    
        return $data;
    }

    /**
     * @param Type $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {
       
        $this->commandBus->handle(new DestroyTypeCommand(
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
