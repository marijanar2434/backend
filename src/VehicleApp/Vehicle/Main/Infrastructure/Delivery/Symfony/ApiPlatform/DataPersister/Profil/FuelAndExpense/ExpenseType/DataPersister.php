<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataPersister\Profil\FuelAndExpense\ExpenseType;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Common\Application\Bus\CommandBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingCommandBus;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType\CreateExpenseTypeCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType\DestroyExpenseTypeCommand;
use App\VehicleApp\Vehicle\Main\Application\Command\Profil\FuelAndExpense\ExpenseType\UpdateExpenseTypeCommand;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

class DataPersister  implements ContextAwareDataPersisterInterface
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
        return $data instanceof ExpenseType;
    }


    public function persist($data, array $context = []): mixed
    {
      
        if ($this->isCreateOperation($context)) {
            $this->commandBus->handle(new CreateExpenseTypeCommand(
                $data->id,
                $data->name
            ));
        }
      

        if ($this->isUpdateOperation($context)) {
            $this->commandBus->handle(new UpdateExpenseTypeCommand(
                $data->id,
                $data->name

            ));
        }

       
        return $data;
    }

    /**
     * @param ExpenseType $data
     * @param array $context
     * 
     * @return void
     */
    public function remove($data, array $context = []): void
    {

        $this->commandBus->handle(new DestroyExpenseTypeCommand(
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
