<?php

namespace App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\DataProvider\Profil\Vehicle;

use App\Common\Infrastructure\Delivery\Symfony\ApiPlatform\Paginator\Paginator;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use App\Common\Application\Bus\QueryBus;
use App\Common\Infrastructure\Delivery\Symfony\Bus\ExceptionHandlingQueryBus;
use App\Common\Shared\Array\Arr;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Damage\DamageDto;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\FuelAndExpense\FuelAndExpenseDto;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Maintenance\MaintenanceDto;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Registration\RegistrationDto;
use App\VehicleApp\Vehicle\Main\Application\Dto\Profil\Vehicle\VehicleDto;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle\VehicleCollectionQuery;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle\VehicleDamageCollectionQuery;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle\VehicleFuelAndExpenseCollectionQuery;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle\VehicleMaintenanceCollectionQuery;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle\VehicleRegistrationsCollectionQuery;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\FuelAndExpense\FuelAndExpense;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Maintenance\Maintenance;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Registration\Registration;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\ApiPlatform\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Infrastructure\Delivery\Symfony\Exception\ExceptionHandler;

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


        return (Vehicle::class === $resourceClass  && ($context['operation_type'] ?? null) !== 'subresource') ||
            (FuelAndExpense::class === $resourceClass  && ($context['operation_type'] ?? null) === 'subresource') ||
            (Registration::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource') ||
            (Maintenance::class === $resourceClass && ($context['operation_type'] ?? null) === 'subresource') ||
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


        $query = new VehicleCollectionQuery(
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            Arr::get($context, 'filters.filter', []),
            Arr::get($context, 'filters.order', ['createdOn' => 'desc'])
        );

        $queryResult = $this->queryBus->handle($query);

        return new Paginator(
            Arr::map($queryResult->getResult(), fn ($dto) => $this->fromVehicleCollectionDto($dto)),
            (int)Arr::get($context, 'filters.page', 1),
            (int)Arr::get($context, 'filters.size', 10),
            $queryResult->getTotal()
        );
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Vehicle
    {

        $query = new VehicleCollectionQuery(
            1,
            1,
            ['and' => [['id' => $id]]],
        );

        $queryResult = $this->queryBus->handle($query);

        if ($queryResult->isEmpty()) {
            return null;
        }

        return $this->fromVehicleCollectionDto($queryResult->getFirst());
    }


    private function fromVehicleCollectionDto(VehicleDto $dto): Vehicle
    {

        $vehicle = new Vehicle();
        $vehicle->id = $dto->getId();
        $vehicle->vehicleActiveFrom = $dto->getVehicleActiveFrom();
        $vehicle->vehicleActiveTo = $dto->getVehicleActiveTo();
        $vehicle->type = $dto->getType();
        $vehicle->brand = $dto->getBrand();
        $vehicle->chassisNumber = $dto->getChassisNumber();
        $vehicle->engineNumber = $dto->getEngineNumber();
        $vehicle->color = $dto->getColor();
        $vehicle->yearOfProduction = $dto->getYearOfProduction();
        $vehicle->price = $dto->getPrice();
        $vehicle->users = $dto->getUsers();
        $vehicle->typeOfUser = $dto->getTypeOfUser();
        $vehicle->images = $dto->getImages();
        $vehicle->documentations = $dto->getDocumentations();

        return $vehicle;
    }


    /**
     * 
     *
     * @param string $resourceClass
     * @param array $identifiers
     * @param array $context
     * @param string|null $operationName
     * @return iterable|object|null
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, string $operationName = null): iterable|object|null
    {
        $query = match ($context['property']) {
            'registrations' => new VehicleRegistrationsCollectionQuery(
                Arr::get($identifiers, 'id.id'),
                Arr::get($context, 'filters.attached', '1') === '1',
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                Arr::get($context, 'filters.filter', []),
                Arr::get($context, 'filters.order', [])
            ),
            'fuelAndExpenses' => new VehicleFuelAndExpenseCollectionQuery(
                Arr::get($identifiers, 'id.id'),
                Arr::get($context, 'filters.attached', '1') === '1',
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                Arr::get($context, 'filters.filter', []),
                Arr::get($context, 'filters.order', [])
            ),
            'maintenances' => new VehicleMaintenanceCollectionQuery(
                Arr::get($identifiers, 'id.id'),
                Arr::get($context, 'filters.attached', '1') === '1',
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                Arr::get($context, 'filters.filter', []),
                Arr::get($context, 'filters.order', [])
            ),
            'damages' => new VehicleDamageCollectionQuery(
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


        $contextProp = $context['property'];
        
        if ($contextProp == 'registrations') {
            return new Paginator(
                Arr::map($queryResult->getResult(), fn ($dto) => $this->fromRegistrationDto($dto)),
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                $queryResult->getTotal()
            );
        } else if ($contextProp == 'fuelAndExpenses') {
            return new Paginator(
                Arr::map($queryResult->getResult(), fn ($dto) => $this->fromFuelAndExpenseDto($dto)),
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                $queryResult->getTotal()
            );
        } else if ($contextProp == 'maintenances') {
            return new Paginator(
                Arr::map($queryResult->getResult(), fn ($dto) => $this->fromMaintenanceDto($dto)),
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                $queryResult->getTotal()
            );
        } else if ($contextProp == 'damages') {
            return new Paginator(
                Arr::map($queryResult->getResult(), fn ($dto) => $this->fromDamageDto($dto)),
                (int)Arr::get($context, 'filters.page', 1),
                (int)Arr::get($context, 'filters.size', 10),
                $queryResult->getTotal()
            );
        }
        else{
            return null;
        }
    }


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
        $registration->documentations = $dto->getDocumentations();

        return $registration;
    }


    private function fromFuelAndExpenseDto(FuelAndExpenseDto $dto): FuelAndExpense
    {

        $fuelAndExpense = new FuelAndExpense();
        $fuelAndExpense->id = $dto->getId();
        $fuelAndExpense->expenseType = $dto->getExpenseType();
        $fuelAndExpense->date = $dto->getDate();
        $fuelAndExpense->mileage = $dto->getMileage();
        $fuelAndExpense->expense = $dto->getExpense();
        $fuelAndExpense->price = $dto->getPrice();
        $fuelAndExpense->user = $dto->getUser();
        $fuelAndExpense->timeOfUser = $dto->getTimeOfUser();



        return $fuelAndExpense;
    }

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
