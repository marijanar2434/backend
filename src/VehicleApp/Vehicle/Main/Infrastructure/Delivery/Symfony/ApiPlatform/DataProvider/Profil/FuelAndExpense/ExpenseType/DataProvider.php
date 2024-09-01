<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\FuelAndExpense\ExpenseType;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\ExpenseType\ExpenseTypeDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense\ExpenseType\ExpenseTypeCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\ExpenseType\ExpenseType;

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

        return (ExpenseType::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (ExpenseType::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }

       
        $query = new ExpenseTypeCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromExpenseTypeDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?ExpenseType
    {
        $query = new ExpenseTypeCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );
              
        $queryResult = $this->queryBus->handle($query);
        
        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromExpenseTypeDto($queryResult->getFirst());
    }

    /**
     * @param ExpenseTypeDto $dto
     *
     * @return ExpenseType
     */
    private function fromExpenseTypeDto(ExpenseTypeDto $dto): ExpenseType
    {
     
        $ExpenseType = new ExpenseType();
        $ExpenseType->id = $dto->getId();
        $ExpenseType->name =  $dto->getName();
        
       
        return $ExpenseType;
    }
}

