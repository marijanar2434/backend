<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Profil\DamageCoverage;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage\CreateDamageCoverageCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage\DestroyDamageCoverageCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\DamageCoverage\UpdateDamageCoverageCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\DamageCoverage\DamageCoverage;
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
        return $data instanceof DamageCoverage;
    }


    public function persist($data, array $context = []): mixed
    {

        if ($this->isCreateOperation($context)) {
            $this->commandBus->handle(new CreateDamageCoverageCommand(
                $data->id,
                $data->name
            ));
        }
      
       
        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateDamageCoverageCommand(
                $data->id,
                $data->name
            ));
        }

        
        return $data;
    }

    /**
     * @param DamageCoverage $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {
        
        $this->commandBus->handle(new DestroyDamageCoverageCommand(
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


