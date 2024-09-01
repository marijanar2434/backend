<?php

namespace App\VehicleApp\Vehicle\Main\Application\Command\HistoryOfChange;

use App\Common\Application\Command\Command;
use App\Common\Application\Command\TransactionalCommand;

class AddChangeLogCommand extends Command implements TransactionalCommand
{


    /**
     * 
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $user;

    /**
     * 
     *
     * @var array
     */
    public $changes;


    public function __construct($id, $user, $changes)
    {
        $this->id = $id;
        $this->user = $user;
        $this->changes = $changes;
    }

    /**
     * @return  string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Get the value of id
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of changes
     *
     * @return  array
     */
    public function getChanges()
    {
        return $this->changes;
    }
}
