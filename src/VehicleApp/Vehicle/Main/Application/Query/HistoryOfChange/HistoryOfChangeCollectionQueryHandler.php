<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\HistoryOfChange;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChangeRepository;

class HistoryOfChangeCollectionQueryHandler implements QueryHandler
{
    /**
     * @var HistoryOfChangeRepository
     */
    private $historyOfChangeRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param HistoryOfChangeRepository $historyOfChangeRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(HistoryOfChangeRepository $historyOfChangeRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->historyOfChangeRepository = $historyOfChangeRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(HistoryOfChangeCollectionQuery $query)
    {
      
        $repositoryQueryResult = $this->historyOfChangeRepository->query(
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


