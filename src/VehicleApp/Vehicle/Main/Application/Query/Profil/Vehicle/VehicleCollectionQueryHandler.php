<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Vehicle;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;

class VehicleCollectionQueryHandler implements QueryHandler
{
    /**
     * @var VehicleRepository
     */
    private  $vehicleRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * Constructor
     *
     * @param VehicleRepository $vehicleRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(VehicleRepository $vehicleRepository, CollectionTransformer $collectionTransformer)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->collectionTransformer = $collectionTransformer;
       
    }

    /**
     * @inheritDoc
     */
    public function __invoke(VehicleCollectionQuery $query)
    {
       
        $repositoryQueryResult = $this->vehicleRepository->query(
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
