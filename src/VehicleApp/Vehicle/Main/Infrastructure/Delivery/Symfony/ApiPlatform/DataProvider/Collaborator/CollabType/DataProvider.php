<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Collaborator\CollabType;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollabType\CollabTypeDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\CollabType\CollabTypeCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Collaborator\CollabType\CollabType;
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

        return (CollabType::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (CollabType::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }

        
        $query = new CollabTypeCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromCollabTypeDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?CollabType
    {
        $query = new CollabTypeCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );
              
        $queryResult = $this->queryBus->handle($query);
        
        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromCollabTypeDto($queryResult->getFirst());
    }

    /**
     * @param CollabTypeDto $dto
     *
     * @return CollabType
     */
    private function fromCollabTypeDto(CollabTypeDto $dto): CollabType
    {

        $collabType = new CollabType();
        $collabType->id = $dto->getId();
        $collabType->name = $dto->getName();
    
        return $collabType;
    }
}