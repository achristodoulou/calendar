<?php

namespace Achristodoulou\Calendar;

/**
 * Class TimeRange
 * @package Ac\Calendar
 */
class TimeRange{

    /**
     * @var TwentyFourHourTime
     */
    private $from;

    /**
     * @var TwentyFourHourTime
     */
    private $to;

    public function __construct(TwentyFourHourTime $from, TwentyFourHourTime $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param TwentyFourHourTime $time
     * @return bool
     */
    public function isTimeInBetween(TwentyFourHourTime $time)
    {
        return $time->getTimeAsInt() >= $this->from->getTimeAsInt() &&
        $time->getTimeAsInt() <= $this->to->getTimeAsInt();
    }
}