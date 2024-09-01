<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\Profil\Damage;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\IdentityAccess\Main\Application\Exception\Identity\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Damage\DamageNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\DamageCoverage\DamageCoverageNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\PartAndService\PartAndServiceNotFoundException;
use App\VehicleApp\Vehicle\Main\Application\Exception\Profil\Vehicle\VehicleNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\Damage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Damage\DamageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverage;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\DamageCoverage\DamageCoverageRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\PartAndService\PartAndServiceRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\Vehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\Profil\Vehicle\VehicleRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicle;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class CreateDamageHandler implements CommandHandler
{
    /**
     * 
     *
     * @var DamageRepository
     */
    private  $damageRepository;

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private $userVehicleRepository;


    /**
     * 
     *
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * 
     *
     * @var DamageCoverageRepository
     */
    private $damageCoverageRepository;


    /**
     * 
     *
     * @var PartAndServiceRepository
     */
    private  $partAndServiceRepository;
   

    public function __construct(
        DamageRepository $damageRepository,
        UserVehicleRepository $userVehicleRepository,
        VehicleRepository $vehicleRepository,
        DamageCoverageRepository $damageCoverageRepository,
        PartAndServiceRepository $partAndServiceRepository
    ) {
        $this->damageRepository = $damageRepository;
        $this->userVehicleRepository = $userVehicleRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->damageCoverageRepository = $damageCoverageRepository;
        $this->partAndServiceRepository = $partAndServiceRepository;
    }

    public function __invoke(CreateDamageCommand $command)
    {

        $objPartAndServices = [];

        $partAndServicesArray = array_unique($command->getPartAndServices());
        foreach ($partAndServicesArray as $part) {

            $obj = $this->partAndServiceRepository->findById(new Id($part));
            if (empty($obj)) {
                throw new PartAndServiceNotFoundException();
            }

            $objPartAndServices[] = $obj;
        }

        /**
         * @var UserVehicle
         */
        $user = $this->userVehicleRepository->findById(new Id($command->getUserId()));

        if ($user == null && $command->getUserId() != null) {
            throw new UserNotFoundException();
        }

        /**
         * @var Vehicle
         */
        $vehicle = $this->vehicleRepository->findById(new Id($command->getVehicleId()));
        if ($vehicle == null) {
            throw new VehicleNotFoundException();
        }

        /**
         * @var DamageCoverage
         */
        $damageCoverage = $this->damageCoverageRepository->findById(new Id($command->getDamageCoverage()));

        if ($damageCoverage == null) {
            throw new DamageCoverageNotFoundException();
        }

        $damage = new Damage(
            new Id($command->getId()),
            $command->getDescription(),
            $damageCoverage,
            $command->getDate(),
            $command->getFee(),
            $vehicle,
            $user,
            $command->getTimeOfUser(),
            $objPartAndServices
        );
        
        $this->damageRepository->save($damage);
    }
}
