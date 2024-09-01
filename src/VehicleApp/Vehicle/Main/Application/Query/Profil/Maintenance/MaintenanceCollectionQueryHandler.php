<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Maintenance;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceRepository;

class MaintenanceCollectionQueryHandler implements QueryHandler
{
    /**
     * @var MaintenanceRepository
     */
    private MaintenanceRepository $maintenanceRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param MaintenanceRepository $maintenanceRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(MaintenanceRepository $maintenanceRepository, CollectionTransformer $collectionTransformer)
    {

        $this->maintenanceRepository = $maintenanceRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(MaintenanceCollectionQuery $query)
    {
       
        $repositoryQueryResult = $this->maintenanceRepository->query(
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



