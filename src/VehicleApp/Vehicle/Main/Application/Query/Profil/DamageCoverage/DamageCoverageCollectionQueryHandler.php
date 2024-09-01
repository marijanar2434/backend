<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\DamageCoverage;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;

class DamageCoverageCollectionQueryHandler implements QueryHandler
{
    /**
     * @var DamageCoverageRepository
     */
    private $damageCoverageRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param DamageCoverageRepository $damageCoverageRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(DamageCoverageRepository $damageCoverageRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->damageCoverageRepository = $damageCoverageRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(DamageCoverageCollectionQuery $query)
    {
        $repositoryQueryResult = $this->damageCoverageRepository->query(
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
