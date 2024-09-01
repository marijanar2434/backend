<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\PartAndService;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;

class PartAndServiceCollectionQueryHandler implements QueryHandler
{
    /**
     * @var PartAndServiceRepository
     */
    private $partAndServiceRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(PartAndServiceRepository $partAndServiceRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->partAndServiceRepository = $partAndServiceRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(PartAndServiceCollectionQuery $query)
    {
        $repositoryQueryResult = $this->partAndServiceRepository->query(
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


