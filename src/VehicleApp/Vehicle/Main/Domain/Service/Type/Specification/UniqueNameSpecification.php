<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Type\Specification;

use App\Common\Domain\Validator\Specification\Specification;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;

class UniqueNameSpecification extends Specification
{
    /**
     * 
     *
     * @var TypeRepository
     */
    private $typeRepository;


    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }


    public function isSatisfiedBy($object): bool
    {
        $type = $this->typeRepository->findByName(
            $object->getName()
        );

        return $type === null || $object->getId()->equals($type->getId());
    }
}
