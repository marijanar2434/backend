<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Service\Validator;

use App\Common\Domain\Validator\ValidationNotificationHandler;
use App\Common\Domain\Validator\Validator;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndService;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\PartAndService\Specification\UniqueNameSpecification;

class PartAndServiceValidator extends Validator
{
    /**
     * @var PartAndServiceRepository
     */ 
    private $partAndServiceRepository;

    /**
     * BrandValidator Constructor
     *
     * @param PartAndServiceRepository $partAndServiceRepository
     */
    public function __construct(PartAndServiceRepository $partAndServiceRepository)
    {
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($object): ValidationNotificationHandler
    {
        $notificationHandler = new ValidationNotificationHandler();

        if (!$this->hasUniqueName($object)) {
            $notificationHandler->addNotification(
                'Part and service with name {{ name }} already exists.',
                ['{{ name }}' => $object->getName()],
                'name'
            );
        }

        return $notificationHandler;
    }

    /**
     * @return boolean
     */
    private function hasUniqueName(PartAndService $partAndService): bool
    {
        return (new UniqueNameSpecification($this->partAndServiceRepository))->isSatisfiedBy($partAndService);
    }
}
