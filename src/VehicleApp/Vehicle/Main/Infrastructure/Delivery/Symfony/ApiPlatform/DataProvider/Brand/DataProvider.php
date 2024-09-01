<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Brand;

use App\Common\Shared\Array\Arr;
use App\Common\Application\Bus\QueryBus;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\VehicleApp\Vehicle\Main\Application\Dto\Brand\BrandDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Brand\BrandCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Brand\Brand;
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

        return (Brand::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Brand::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {

        if ($operationName !== 'get') {
            return [];
        }

        $query = new BrandCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );


        $queryResult = $this->queryBus->handle($query);

        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromBrandDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Brand
    {
        $query = new BrandCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

        $queryResult = $this->queryBus->handle($query);

        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromBrandDto($queryResult->getFirst());
    }

    /**
     * @param BrandDto $dto
     *
     * @return Brand
     */
    private function fromBrandDto(BrandDto $dto): Brand
    {

        $brand = new Brand();
        $brand->id = $dto->getId();
        $brand->name = $dto->getName();
        return $brand;
    }
}
