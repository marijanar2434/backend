<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\Brand;
use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\VehicleApp\Vehicle\Main\Domain\Model\Brand\BrandRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Brand\Specification\UniqueNameSpecification;

class BrandValidator extends Validator
{
    /**
     * @var BrandRepository
     */ 
    private $brandRepository;

    /**
     * BrandValidator Constructor
     *
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Brand with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(Brand $brand): bool
    {
        return (new UniqueNameSpecification($this->brandRepository))->isSatisfiedBy($brand);
    }
}
