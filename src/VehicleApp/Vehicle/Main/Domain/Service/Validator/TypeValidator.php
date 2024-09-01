<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\Type;
use App\VehicleApp\Vehicle\Main\Domain\Model\Type\TypeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Type\Specification\UniqueNameSpecification;

class TypeValidator extends Validator
{
    /**
     * @var TypeRepository
     */
    private  $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Type with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }
        return $notificationHandler;
    }


    private function hasUniqueName(Type $type): bool
    {
        return (new UniqueNameSpecification($this->typeRepository))->isSatisfiedBy($type);
    }
}
