<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Domain\ValueObject\Id;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Registration\RegistrationRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class VehicleRegistrationsQueryHandler implements QueryHandler
{
    /**
     * 
     *
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * 
     *
     * @var RegistrationRepository
     */
    private  $registrationRepository;

    /**
     * @var CollectionTransformer
     */
    private  $collectionTransformer;

    /**
     * UserRolesCollectionQueryHandler Constructor
     *
     * @param VehicleRepository $vehicleRepository
     * @param RegistrationRepository $registrationRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(VehicleRepository $vehicleRepository, RegistrationRepository $registrationRepository, CollectionTransformer $collectionTransformer)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->registrationRepository = $registrationRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(VehicleRegistrationsCollectionQuery $query)
    {
        /**
         * @var Vehicle|null
         */
        
        $vehicle = $this->vehicleRepository->findById(new Id($query->getVehicleId()));

       
        if (empty($vehicle)) {
            throw new VehicleNotFoundException();
        }

            $repositoryQueryResult = $this->registrationRepository->VehicleRegistrationsGet(
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

