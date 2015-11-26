<?php

namespace Achristodoulou\Calendar;

/**
 * Class TwentyFourHourTime
 * @package Ac\Calendar
 */
class TwentyFourHourTime {

    private $time;

    /**
     * @param string $time
     */
    public function __construct($time)
    {
        $this->validateTime($time);

        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getTimeAsInt()
    {
        return (int) str_replace(':', '', $this->time);
    }

    /**
     * @return bool
     */
    public function isMidnight()
    {
        $time = substr($this->time, 0, 2);

        return $time == '00';
    }

    /**
     * @return bool
     */
    public function isNoon()
    {
        $time = (int) substr($this->time, 0, 2);

        return $time === 12;
    }

    /**
     * @param $time
     */
    private function validateTime($time)
    {
        $timeExpression = '(2[0-3]|[01][0-9]):([0-5][0-9])';

        if(preg_match("/^$timeExpression$/", $time) !== 1)
            throw new \InvalidArgumentException('Time must have the following format HH:MM');
    }
}