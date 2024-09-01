<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Profil\Damage;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage\CreateDamageCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage\DestroyDamageCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage\UpdateDamageCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Damage\Damage;
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
        return $data instanceof Damage;
    }


    public function persist($data, array $context = []): mixed
    {
        
        if ($this->isCreateOperation($context)) {
            $this->commandBus->handle(new CreateDamageCommand(
                $data->id,
                $data->date,
                $data->description,
                $data->fee,
                $data->user,
                $data->timeOfUser,
                $data->vehicle,
                $data->damageCoverage,
                $data->partAndServices
            ));
        }
      
       
        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateDamageCommand(
                $data->id,
                $data->description,
                $data->date,
                $data->fee,
                $data->user,
                $data->timeOfUser,
                $data->damageCoverage,
                $data->vehicle
            ));
        }

       
        return $data;
    }

    /**
     * @param Damage $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {
        
        $this->commandBus->handle(new DestroyDamageCommand(
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


