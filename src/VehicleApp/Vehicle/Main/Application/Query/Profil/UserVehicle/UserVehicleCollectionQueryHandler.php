<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\UserVehicle;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Application\Query\Profil\UserVehicle\UserVehicleCollectionQuery;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class UserVehicleCollectionQueryHandler implements QueryHandler
{
    /**
     * @var UserVehicleRepository
     */
    private  $userVehicleRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * Constructor
     *
     * @param UserVehicleRepository $userVehicleRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(UserVehicleRepository $userVehicleRepository, CollectionTransformer $collectionTransformer)
    {
       
        $this->userVehicleRepository = $userVehicleRepository;
        $this->collectionTransformer = $collectionTransformer;
       
    }

    /**
     * @inheritDoc
     */
    public function __invoke(UserVehicleCollectionQuery $query)
    {
       
        $repositoryQueryResult = $this->userVehicleRepository->query(
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
