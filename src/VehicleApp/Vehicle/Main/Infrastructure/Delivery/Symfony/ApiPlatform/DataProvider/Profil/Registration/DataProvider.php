<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\Registration;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Registration\RegistrationDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Registration\RegistrationCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Registration\Registration;
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

        return (Registration::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (Registration::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = []): iterable
    {
        
        if ($operationName !== 'get') {
            return [];
        }

       
        $query = new RegistrationCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        
        $queryResult = $this->queryBus->handle($query);

       
        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromRegistrationDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Registration
    {
        $query = new RegistrationCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );
              
        $queryResult = $this->queryBus->handle($query);
        
        if ($queryResult->isEmpty()) {
            return null;
        }
    
        return $this->fromRegistrationDto($queryResult->getFirst());
    }

    /**
     * @param RegistrationDto $dto
     *
     * @return Registration
     */
    private function fromRegistrationDto(RegistrationDto $dto): Registration
    {
        
        $registration = new Registration();
        $registration->id = $dto->getId();
        $registration->timeOfUser = $dto->getTimeOfuser();
        $registration->registrationExpire = $dto->getRegistrationExpire();
        $registration->registrationNumber = $dto->getRegistrationNumber();
        $registration->registrationFee = $dto->getRegistrationFee();
        $registration->registrationStartDate = $dto->getRegistrationStartDate();
        $registration->registrationExpire = $dto->getRegistrationExpire();
        $registration->user = $dto->getUser();
        $registration->vehicle =  $dto->getVehicle();
        $registration->documentations = $dto->getDocumentations();
       
        return $registration;
    }

}