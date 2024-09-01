<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class VehicleDamageQueryHandler implements QueryHandler
{
    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var DamageRepository
     */
    private  $damageRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * UserRolesCollectionQueryHandler Constructor
     *
     * @param VehicleRepository $vehicleRepository
     * @param DamageRepository $damageRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(VehicleRepository $vehicleRepository, DamageRepository $damageRepository, CollectionTransformer $collectionTransformer)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->damageRepository = $damageRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(VehicleDamageCollectionQuery $query)
    {
   
        $vehicle = $this->vehicleRepository->findById(new Id($query->getVehicleId()));

       
        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

            $repositoryQueryResult = $this->damageRepository->VehicleDamageGet(
                $vehicle->getId(),
                new Criteria(
                    $query->getFilter(),
                    $query->getPage(),
                    $query->getLimit(),
                    $query->getOrder()
                )
            );

          
        $this->collectionTransformer->write(
            $repositoryQueryResult->getResult()
        );

        return new QueryResult(
            $this->collectionTransformer->read(),
            $repositoryQueryResult->getTotal()
        );
    }
}



