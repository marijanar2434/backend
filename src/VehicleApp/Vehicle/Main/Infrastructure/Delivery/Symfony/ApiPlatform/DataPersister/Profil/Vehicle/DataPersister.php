<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Profil\Vehicle;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\CreateVehicleCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\DestroyVehicleCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Vehicle\UpdateVehicleCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Vehicle;

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
        return $data instanceof Vehicle;
    }

  
    public function persist($data, array $context = []): mixed
    { 
        if ($this->isCreateOperation($context)) {
            $this->commandBus->handle(new CreateVehicleCommand(
                $data->id,
                $data->type,
                $data->price,
                $data->color,
                $data->chassisNumber,
                $data->engineNumber,
                $data->yearOfProduction,
                $data->vehicleActiveFrom,
                !empty($data->vehicleActiveTo) ? $data->vehicleActiveTo : null
            ));
        }

      
        if ($this->isUpdateOperation($context)) {
          
            $this->commandBus->handle(new UpdateVehicleCommand(
                $data->id,
                $data->price,
                $data->color,
                $data->chassisNumber,
                $data->engineNumber,
                $data->yearOfProduction,
                $data->vehicleActiveFrom,
                !empty($data->vehicleActiveTo) ? $data->vehicleActiveTo : null
            ));
        }

       
        return $data;
    }

    /**
     * @param Vehicle $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {
        $this->commandBus->handle(new DestroyVehicleCommand(
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

