<?php

namespace App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\Change;

use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Entity;
use App\Common\Domain\RecordingDomainEvents;
use App\Common\Domain\ValueObject\Id;
use App\VehicleApp\Vehicle\Main\Domain\Model\HistoryOfChange\HistoryOfChange;

class Change extends Entity implements RecordingDomainEvents
{

    use DateTimeTracking, DomainEventRecording;


    /**
     * 
     *
     * @var string
     */
    private $change;


    /**
     * 
     *
     * @var HistoryOfChange
     */
    private $historyOfChange;

    /**
     * 
     *
     * @param Id $id
     * @param string $change
     */
    public function __construct(Id $id, HistoryOfChange $historyOfChange, string $change)
    {
        parent::__construct($id);
        $this->setHistoryOfChange($historyOfChange);
        $this->setChange($change);
    }

    /**
     * Get the value of change
     *
     * @return  string
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * Set the value of change
     *
     * @param  string  $change
     *
     * @return  self
     */
    public function setChange(string $change)
    {
        $this->change = $change;
        return $this;
    }

    /**
     * Get the value of historyOfChange
     *
     * @return  HistoryOfChange
     */
    public function getHistoryOfChange()
    {
        return $this->historyOfChange;
    }

    /**
     * Set the value of historyOfChange
     *
     * @param  HistoryOfChange  $historyOfChange
     *
     * @return  self
     */
    public function setHistoryOfChange(HistoryOfChange $historyOfChange)
    {
        $this->historyOfChange = $historyOfChange;
        return $this;
    }
}
