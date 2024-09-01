<?php

namespace App\VehicleApp\Vehicle\Main\Application\Dto\HistoryOfChange;

class HistoryOfChangeDto
{


    /**
     * 
     *
     * @var string
     */
    private  $id;


    /**
     * 
     *
     * @var string
     */
    private  $user;


    /**
     * 
     *
     * @var array
     */
    private  $changes;


    public function __construct($id, $user, $changes)
    {

        $this->id = $id;
        $this->user = $user;
        $this->changes = $changes;
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
     * Get the value of user
     *
     * @return  string
     */
    public function getUser()
    {
        return $this->user;
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
