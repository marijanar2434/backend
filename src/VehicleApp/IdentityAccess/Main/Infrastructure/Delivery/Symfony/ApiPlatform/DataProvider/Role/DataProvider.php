<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Role;

use App\Common\Shared\Array\Arr;
use App\Common\Application\Bus\QueryBus;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Access\RoleDto;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\VehicleApp\IdentityAccess\Main\Application\Query\Access\RoleCollectionQuery;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Role\Role;

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
        return (Role::class === $resourceClass && ($context['operation_type'] ?? null) !== 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        $query = new RoleCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        $queryResult = $this->queryBus->handle($query);

        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromRoleDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Role
    {
        $query = new RoleCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

        $queryResult = $this->queryBus->handle($query);

        if ($queryResult->isEmpty()) {
            return null;
        }

        return $this->fromRoleDto($queryResult->getFirst());
    }

    /**
     * @param RoleDto $dto
     *
     * @return Role
     */
    private function fromRoleDto(RoleDto $dto): Role
    {
        $role = new Role();
        $role->id = $dto->getId();
        $role->name = $dto->getName();
        $role->identifier = $dto->getIdentifier();
        $role->active = $dto->getActive();

        return $role;
    }
}
