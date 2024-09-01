<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Type;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;

class TypeCollectionQueryHandler implements QueryHandler
{
    /**
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     * Constructor
     *
     * @param TypeRepository $typeRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(TypeRepository $typeRepository, CollectionTransformer $collectionTransformer)
    {
        $this->typeRepository = $typeRepository;
        $this->collectionTransformer = $collectionTransformer;
       
    }

    /**
     * @inheritDoc
     */
    public function __invoke(TypeCollectionQuery $query)
    {

        $repositoryQueryResult = $this->typeRepository->query(
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