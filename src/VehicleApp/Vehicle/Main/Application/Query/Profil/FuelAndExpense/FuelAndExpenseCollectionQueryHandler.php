<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\FuelAndExpense;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\FuelAndExpense\FuelAndExpenseRepository;

class FuelAndExpenseCollectionQueryHandler implements QueryHandler
{
    /**
     * @var FuelAndExpenseRepository
     */
    private  $fuelAndExpenseRepository;

    /**
     * @var CollectionTransformer
     */
    private  $collectionTransformer;

    /**
     *  Constructor
     *
     * @param FuelAndExpenseRepository $fuelAndExpenseRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(FuelAndExpenseRepository $fuelAndExpenseRepository, CollectionTransformer $collectionTransformer)
    {

        $this->fuelAndExpenseRepository = $fuelAndExpenseRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(FuelAndExpenseCollectionQuery $query)
    {
        $repositoryQueryResult = $this->fuelAndExpenseRepository->query(
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
