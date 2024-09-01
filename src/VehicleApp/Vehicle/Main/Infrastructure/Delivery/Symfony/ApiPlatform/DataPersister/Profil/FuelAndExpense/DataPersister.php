<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Profil\FuelAndExpense;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\CreateFuelAndExpenseCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\DestroyFuelAndExpenseCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\UpdateFuelAndExpenseCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\FuelAndExpense;
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
        return $data instanceof FuelAndExpense;
    }


    public function persist($data, array $context = []): mixed
    {
    
       
        if ($this->isCreateOperation($context)) {
          
            $this->commandBus->handle(new CreateFuelAndExpenseCommand(
                $data->id,
                $data->date,
                $data->mileage,
                $data->expense,
                $data->price,
                $data->user,
                $data->timeOfUser,
                $data->vehicle,
                $data->expenseType
            ));
        }
      
       
        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateFuelAndExpenseCommand(
                $data->id,
                $data->date,
                $data->timeOfUser,
                $data->price,
                $data->expense,
                $data->user,
                $data->mileage,
                $data->vehicle
            ));
        }

       
        return $data;
    }

    /**
     * @param FuelAndExpense $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {

        $this->commandBus->handle(new DestroyFuelAndExpenseCommand(
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
