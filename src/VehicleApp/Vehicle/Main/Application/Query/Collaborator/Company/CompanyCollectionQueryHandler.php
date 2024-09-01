<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Collaborator\Company;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Collaborator\Company\CompanyRepository;

class CompanyCollectionQueryHandler implements QueryHandler
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param CompanyRepository $companyRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(CompanyRepository $companyRepository, CollectionTransformer $collectionTransformer)
    {
       
        $this->companyRepository = $companyRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(CompanyCollectionQuery $query)
    {
        
        $repositoryQueryResult = $this->companyRepository->query(
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
