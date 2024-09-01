<?php

namespace App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\User;

use App\Common\Shared\Array\Arr;
use App\Common\Application\Bus\QueryBus;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Access\RoleDto;
use App\VehicleApp\IdentityAccess\Main\Application\Dto\Identity\UserDto;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\VehicleApp\IdentityAccess\Main\Application\Query\Identity\UserCollectionQuery;
use App\VehicleApp\IdentityAccess\Main\Application\Query\Access\UserRolesCollectionQuery;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Role\Role;
use App\VehicleApp\IdentityAccess\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\User\User;

class DataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface, SubresourceDataProviderInterface
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
        
        return (User::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Role::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        if ($operationName !== 'get') {
            return [];
        }

        $query = new UserCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        $queryResult = $this->queryBus->handle($query);

        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromUserDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?User
    {
        $query = new UserCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

    
        $queryResult = $this->queryBus->handle($query);

      

        if ($queryResult->isEmpty()) {
            return null;
        }

        return $this->fromUserDto($queryResult->getFirst());
    }

    /**
     * @param UserDto $dto
     *
     * @return User
     */
    private function fromUserDto(UserDto $dto): User
    {
        $user = new User();
        $user->id = $dto->getId();
        $user->fullName = $dto->getFullName();
        $user->username = $dto->getUsername();
        $user->email = $dto->getEmail();
        $user->active = $dto->getActive();
        $user->avatar = $dto->getAvatar();
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, string $operationName = null): iterable|object|null
    {
        //dd($identifiers);
        $query = match ($context['property']) {
            'roles' => new UserRolesCollectionQuery(
                Arr::get($identifiers, 'id.id'),
                Arr::get($context, 'filters.attached', '1') === '1',
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                Arr::get($context, 'filters.filter', []),
                Arr::get($context, 'filters.order', [])
            ),
            default => null
        };

        

        if (empty($query)) {
            return null;
        }


        $queryResult = $this->queryBus->handle($query);

        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromRoleDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
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
