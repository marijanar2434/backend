<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Damage\DamageNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage\DamageCoverageNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;
use DateTimeImmutable;

class UpdateDamageHandler implements CommandHandler
{

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private $userRepository;

    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var DamageRepository
     */
    private $damageRepository;

    /**
     * 
     *
     * @var DamageCoverageRepository
     */
    private  $damageCoverageRepository;


    public function __construct(
        UserVehicleRepository $userRepository,
        VehicleRepository $vehicleRepository,
        DamageRepository $damageRepository,
        DamageCoverageRepository $damageCoverageRepository
    ) {
        $this->userRepository = $userRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->damageRepository = $damageRepository;
        $this->damageCoverageRepository = $damageCoverageRepository;
    }

    public function __invoke(UpdateDamageCommand $command)
    {

        /**
         * @var Damage|null
         */
        $damage = $this->damageRepository->findById(new Id($command->getId()));

        if (empty($damage)) {
            throw new DamageNotFoundException();
        }

        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));

        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }



        if ($command->getUserId() != null) {
            /**
             *@var UserVehicle
             */
            $user = $this->userRepository->findByName($command->getUserId()) == null ? $this->userRepository->findById(new Id($command->getUserId()))  : $this->userRepository->findByName($command->getUserId());

            if ($user == null) {
                throw new UserNotFoundException();
            }
        } else {
            $user = null;
        }

        /**
         * @var DamageCoverage
         */
        $damageCoverage = $this->damageCoverageRepository->findById(new Id($command->getDamageCoverage()));

        if ($damageCoverage == null) {
            throw new DamageCoverageNotFoundException();
        }


        $damage->updateProperties(
            $command->getDescription(),
            $damageCoverage,
            $command->getDate(),
            $command->getFee(),
            $vehicle,
            $user,
            $command->getTimeOfUser()
        );


        $this->damageRepository->save($damage);
    }
}
