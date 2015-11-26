<?php

namespace Achristodoulou\Calendar;

/**
 * Class Today
 * @package Ac\Calendar
 */
class Today extends Day{

    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @var ListOfDates
     */
    protected $publicHolidays;

    /**
     * @var TimeRange
     */
    private $workingHours;
    /**
     * @var ListOfDates
     */
    private $annualLeaves;
    /**
     * @var TimeRange
     */
    private $lunchTime;

    /**
     * @param \DateTime $dateTime
     * @param TimeRange $workingHours
     * @param ListOfDates $publicHolidays
     * @param ListOfDates $annualLeaves
     * @param TimeRange $lunchTime
     */
    public function __construct(\DateTime $dateTime,
                                TimeRange $workingHours = null,
                                ListOfDates $publicHolidays = null,
                                ListOfDates $annualLeaves = null,
                                TimeRange $lunchTime = null)
    {
        $this->dateTime = $dateTime;
        $this->publicHolidays = $publicHolidays;
        $this->workingHours = $workingHours;
        $this->annualLeaves = $annualLeaves;
        $this->lunchTime = $lunchTime;
    }

    /**
     * Check if the day is as specified
     * @param int $day
     * @return bool
     */
    public function is($day)
    {
        return $day === (int) $this->dateTime->format('N');
    }

    /**
     * @return bool
     */
    public function isWorkingDay()
    {
        $day = (int) $this->dateTime->format('N');
        return in_array($day, [Day::MONDAY, Day::TUESDAY, Day::WEDNESDAY, Day::THURSDAY, Day::FRIDAY]);
    }

    /**
     * @return bool
     */
    public function isWeekend()
    {
        $day = (int) $this->dateTime->format('N');
        return in_array($day, [Day::SATURDAY, Day::SUNDAY]);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isPublicHoliday()
    {
        if($this->annualLeaves === null)
            throw new \Exception('Public holidays are not set!');

        foreach ($this->publicHolidays->all() as $current) {
            if ($this->dateTime->format('Y-m-d') == $current->format('Y-m-d'))
                return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isAnnualLeave()
    {
        if($this->annualLeaves === null)
            throw new \Exception('Annual leaves are not set!');

        foreach ($this->annualLeaves->all() as $current) {
            if ($this->dateTime->format('Y-m-d') == $current->format('Y-m-d'))
                return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isLunchTime()
    {
        if($this->workingHours === null)
            throw new \Exception('Lunch time is not set!');

        if($this->isWorkingDay() === false)
            return false;

        $current = $this->dateTime->format('H:i');

        $currentTime = new TwentyFourHourTime($current);

        return $this->lunchTime->isTimeInBetween($currentTime);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isWorkingHour()
    {
        if($this->workingHours === null)
            throw new \Exception('Working hours are not set!');

        if($this->isWorkingDay() === false)
            return false;

        $current = $this->dateTime->format('H:i');

        $currentTime = new TwentyFourHourTime($current);

        return $this->workingHours->isTimeInBetween($currentTime);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isAfterWorkingHour()
    {
        if($this->workingHours === null)
            throw new \Exception('Working hours are not set!');

        if($this->isWorkingDay() === false)
            return false;

        $current = $this->dateTime->format('H:i');

        $currentTime = new TwentyFourHourTime($current);

        return !$this->workingHours->isTimeInBetween($currentTime);
    }

    /**
     * @return bool
     */
    public function isNewYearDay()
    {
        $day = (int) $this->dateTime->format('jn');
        return 11 === $day;
    }

    /**
     * @return bool
     */
    public function isEpiphanyDay()
    {
        $day = (int) $this->dateTime->format('jn');
        return 61 === $day;
    }

    /**
     * @return bool
     */
    public function isAnnunciationDay()
    {
        $day = (int) $this->dateTime->format('jn');
        return 253 === $day;
    }

    /**
     * @return bool
     */
    public function isLabourDay()
    {
        $day = (int) $this->dateTime->format('jn');
        return 15 === $day;
    }

    /**
     * @return bool
     */
    public function isAssumptionDay()
    {
        $day = (int) $this->dateTime->format('jn');
        return 158 === $day;
    }

    /**
     * @return bool
     */
    public function isChristmas()
    {
        $day = (int) $this->dateTime->format('jn');
        return 2512 === $day;
    }

    /**
     * @return bool
     */
    public function isMidnightOfWorkingDay()
    {
        if($this->isWorkingDay() === false)
            return false;

        $current = $this->dateTime->format('H:i');

        $currentTime = new TwentyFourHourTime($current);

        return $currentTime->isMidnight();
    }

    /**
     * @return bool
     */
    public function isNoonOfWorkingDay()
    {
        if($this->isWorkingDay() === false)
            return false;

        $current = $this->dateTime->format('H:i');

        $currentTime = new TwentyFourHourTime($current);

        return $currentTime->isNoon();
    }
}