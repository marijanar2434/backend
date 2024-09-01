<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Maintenance\MaintenanceType;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Maintenance\MaintenanceType\MaintenanceTypeRepository;

class MaintenanceTypeCollectionQueryHandler implements QueryHandler
{
    /**
     * @var MaintenanceTypeRepository
     */
    private $maintenanceTypeRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param MaintenanceTypeRepository $maintenanceTypeRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(MaintenanceTypeRepository $maintenanceTypeRepository, CollectionTransformer $collectionTransformer)
    {

        $this->maintenanceTypeRepository = $maintenanceTypeRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(MaintenanceTypeCollectionQuery $query)
    {
       
        $repositoryQueryResult = $this->maintenanceTypeRepository->query(
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


