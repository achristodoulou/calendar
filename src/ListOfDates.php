<?php

namespace Achristodoulou\Calendar;

/**
 * Class ListOfDates
 * @package Ac\Calendar
 */
class ListOfDates{

    /**
     * @var \DateTime[]
     */
    private $listOfDates = [];

    public function add(\DateTime $newDate)
    {
        if(sizeof($this->listOfDates) > 0) {
            foreach ($this->listOfDates as $date) {
                if ($newDate->getTimestamp() === $date->getTimestamp())
                    throw new \InvalidArgumentException(sprintf('Date %s already exists!', $newDate->format('Y-m-d H:i:s')));
            }
        }

        $this->listOfDates[] = $newDate;
    }

    /**
     * Get list of available dates
     * @return \DateTime[]
     */
    public function all()
    {
        return $this->listOfDates;
    }
}