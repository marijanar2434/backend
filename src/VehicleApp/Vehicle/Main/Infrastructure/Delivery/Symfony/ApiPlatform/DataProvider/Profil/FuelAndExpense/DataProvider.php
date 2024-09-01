<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\FuelAndExpense;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\FuelAndExpenseDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense\FuelAndExpenseCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

class DataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * DataProvider Constructor
     *
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = new ExceptionHandlingQueryBus($queryBus, new ExceptionHandler);
    }

    /**
     * @inheritDoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {

        return (FuelAndExpense::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (FuelAndExpense::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }

       
        $query = new FuelAndExpenseCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromFuelAndExpenseDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?FuelAndExpense
    {
        $query = new FuelAndExpenseCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );
              
        $queryResult = $this->queryBus->handle($query);
        
        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromFuelAndExpenseDto($queryResult->getFirst());
    }

    /**
     * @param FuelAndExpenseDto $dto
     *
     * @return FuelAndExpense
     */
    private function fromFuelAndExpenseDto(FuelAndExpenseDto $dto): FuelAndExpense
    {
        $fuelAndExpense = new FuelAndExpense();
        $fuelAndExpense->id = $dto->getId();
        $fuelAndExpense->date = $dto->getDate();
        $fuelAndExpense->price = $dto->getPrice();
        $fuelAndExpense->expense  = $dto->getExpense();
        $fuelAndExpense->mileage = $dto->getMileage();
        $fuelAndExpense->user = $dto->getUser();
        $fuelAndExpense->timeOfUser = $dto->getTimeOfUser();
        $fuelAndExpense->expenseType = $dto->getExpenseType();
        
       
        return $fuelAndExpense;
    }
}
