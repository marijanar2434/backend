<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Brand;

use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;

class BrandCollectionQueryHandler implements QueryHandler
{
    /**
     * @var BrandRepository
     */
    private  $brandRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param BrandRepository $brandRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(BrandRepository $brandRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->brandRepository = $brandRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(BrandCollectionQuery $query)
    {
      
        $repositoryQueryResult = $this->brandRepository->query(
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

