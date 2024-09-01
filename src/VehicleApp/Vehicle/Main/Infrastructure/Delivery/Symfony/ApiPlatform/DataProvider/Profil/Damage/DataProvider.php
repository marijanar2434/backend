<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\Damage;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Damage\DamageDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Damage\DamageCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Damage\Damage;
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

        return (Damage::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Damage::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }
       
        
        $query = new DamageCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromDamageDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Damage
    {
        $query = new DamageCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );
              
        $queryResult = $this->queryBus->handle($query);
        
        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromDamageDto($queryResult->getFirst());
    }

    /**
     * @param DamageDto $dto
     *
     * @return Damage
     */
    private function fromDamageDto(DamageDto $dto): Damage
    {
        $damage = new Damage();

        $damage->id = $dto->getId();
        $damage->description = $dto->getDescription();
        $damage->damageCoverage = $dto->getDamageCoverage();
        $damage->date = $dto->getDate();
        $damage->fee = $dto->getFee();
        $damage->user = $dto->getUser();
        $damage->timeOfUser = $dto->getTimeOfUser();
        $damage->partAndServices = $dto->getPartAndServices();

    
        return $damage;
    }
}
