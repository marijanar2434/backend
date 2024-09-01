<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Damage\DamageNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Service\Profil\Damage\DamageDestroyer;

class DestroyDamageHandler implements CommandHandler
{

    /**
     * 
     *
     * @var DamageRepository
     */
    private $damageRepository;

    /**
     * 
     *
     * @var DamageDestroyer
     */
    private $damageDestroyer;


    /**
     * 
     *
     * @param DamageRepository $damageRepository
     * @param DamageDestroyer $damageDestroyer
     */
    public function __construct(DamageRepository $damageRepository, DamageDestroyer $damageDestroyer)
    {
        $this->damageRepository = $damageRepository;
        $this->damageDestroyer = $damageDestroyer;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(DestroyDamageCommand $command)
    {
        /**
         * @var Damage|null
         */
        
        $damage = $this->damageRepository->findById(new Id($command->getId()));

        if (empty($damage)) {
            throw new DamageNotFoundException();
        }
        $this->damageDestroyer->destroy($damage);
    }
}

