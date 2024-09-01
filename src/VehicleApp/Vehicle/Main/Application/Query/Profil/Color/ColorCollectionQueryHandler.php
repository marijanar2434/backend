<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Color;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Color\ColorRepository;

class ColorCollectionQueryHandler implements QueryHandler
{
    /**
     * @var ColorRepository
     */
    private $colorRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param ColorRepository $colorRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(ColorRepository $colorRepository, CollectionTransformer $collectionTransformer)
    {
      
        $this->colorRepository = $colorRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(ColorCollectionQuery $query)
    {
        $repositoryQueryResult = $this->colorRepository->query(
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

