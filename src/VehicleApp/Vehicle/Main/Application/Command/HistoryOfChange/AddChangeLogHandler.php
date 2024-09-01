<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\HistoryOfChange;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Application\Exception\User\UserNotFoundException;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change\Change;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChange;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChangeRepository;
use App\VehicleApp\Vehicle\Main\Domain\Model\UserVehicle\UserVehicleRepository;

class AddChangeLogHandler  implements CommandHandler
{
    /**
     * 
     *
     * @var HistoryOfChangeRepository
     */
    private $historyOfChangeRepository;

    /**
     * 
     *
     * @var UserVehicleRepository
     */
    private $userVehicleRepository;


    public function __construct(HistoryOfChangeRepository $historyOfChangeRepository, UserVehicleRepository $userVehicleRepository)
    {
        $this->historyOfChangeRepository = $historyOfChangeRepository;
        $this->userVehicleRepository = $userVehicleRepository;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(AddChangeLogCommand $command)
    {


        $user = $this->userVehicleRepository->findByName(new Id($command->getUser()));

        if(empty($user))
        {
            throw new UserNotFoundException();
        }

     
        $historyOfChange = new HistoryOfChange(
            new Id($command->getId()),
            $user,
            $command->getChanges()
        );

        $this->historyOfChangeRepository->save($historyOfChange);
    }
}
