<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\Maintenance;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Maintenance\MaintenanceCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Maintenance\Maintenance;
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

        return (Maintenance::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Maintenance::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {

        if ($operationName !== 'get') {
            return [];
        }


        $query = new MaintenanceCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );


        $queryResult = $this->queryBus->handle($query);


        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromMaintenanceDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Maintenance
    {
        $query = new MaintenanceCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

        $queryResult = $this->queryBus->handle($query);

        if ($queryResult->isEmpty()) {
            return null;
        }

        return $this->fromMaintenanceDto($queryResult->getFirst());
    }

    /**
     * @param MaintenanceDto $dto
     *
     * @return Maintenance
     */
    private function fromMaintenanceDto(MaintenanceDto $dto): Maintenance
    {
        $maintenance = new Maintenance();
        $maintenance->id = $dto->getId();
        $maintenance->date = $dto->getDate();
        $maintenance->fee = $dto->getFee();
        $maintenance->mileage = $dto->getMileage();
        $maintenance->user = $dto->getUser();
        $maintenance->timeOfUser = $dto->getTimeOfUser();
        $maintenance->maintenanceType = $dto->getType();
        $maintenance->partAndServices = $dto->getPartAndServices();


        return $maintenance;
    }
}
