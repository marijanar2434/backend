<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Collaborator;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Collaborator\CollaboratorDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\CollaboratorCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Collaborator\Collaborator;
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
      
        return (Collaborator::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Collaborator::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }


        $query = new CollaboratorCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

       
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromCollaboratorDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Collaborator
    {
        $query = new CollaboratorCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

        $queryResult = $this->queryBus->handle($query);

        if ($queryResult->isEmpty()) {
            return null;
        }

        return $this->fromCollaboratorDto($queryResult->getFirst());
    }

    /**
     * @param CollaboratorDto $dto
     *
     * @return Collaborator
     */
    private function fromCollaboratorDto(CollaboratorDto $dto): Collaborator
    {
        $collaborator = new Collaborator();
        $collaborator->id = $dto->getId();
        $collaborator->fullname = $dto->getFullname();
        $collaborator->email = $dto->getEmail();
        $collaborator->address = $dto->getAddress();
        $collaborator->companyName = $dto->getCompanyName();
        $collaborator->companyCode = $dto->getCompanyCode();
        $collaborator->phoneNumber = $dto->getPhoneNumber();
        $collaborator->website = $dto->getWebsite();
        $collaborator->types = $dto->getTypes();


        return $collaborator;
    }
}
