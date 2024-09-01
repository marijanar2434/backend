<?php

namespace App\VehicleApp\Vehicle\Main\Application\Query\Profil\Image;

use App\Common\Application\Query\QueryHandler;
use App\Common\Application\Query\QueryResult;
use App\Common\Application\Transformer\CollectionTransformer;
use App\Common\Infrastructure\Persistence\Query\Criteria;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Image\ImageRepository;

class ImageCollectionQueryHandler implements QueryHandler
{
    /**
     * @var ImageRepository
     */
    private  $imageRepository;

    /**
     * @var CollectionTransformer
     */
    private $collectionTransformer;

    /**
     *  Constructor
     *
     * @param ImageRepository $imageRepository
     * @param CollectionTransformer $collectionTransformer
     */
    public function __construct(ImageRepository $imageRepository, CollectionTransformer $collectionTransformer)
    {

        $this->imageRepository = $imageRepository;
        $this->collectionTransformer = $collectionTransformer;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(ImageCollectionQuery $query)
    {
       
        $repositoryQueryResult = $this->imageRepository->query(
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



