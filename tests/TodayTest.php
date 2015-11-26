<?php

namespace Achristodoulou\Test;

use Achristodoulou\Calendar\Day;
use \Achristodoulou\Calendar\ListOfDates;
use \Achristodoulou\Calendar\TimeRange;
use \Achristodoulou\Calendar\TwentyFourHourTime;
use \Achristodoulou\Calendar\Today;

class TodayTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Achristodoulou\Calendar\Today
     */
    protected $today;

    public function setUp()
    {
        $currentTime = new \DateTime('2015-11-26 10:00');

        $workingHours = new TimeRange(new TwentyFourHourTime('08:00'), new TwentyFourHourTime('18:00'));

        $publicHolidays = new ListOfDates();
        $publicHolidays->add(new \DateTime('2015-01-18'));
        $publicHolidays->add(new \DateTime('2015-01-25'));

        $annualLeave = new ListOfDates();
        $annualLeave->add(new \DateTime('2015-07-30'));

        $lunchTime = new TimeRange(new TwentyFourHourTime('12:00'), new TwentyFourHourTime('13:00'));

        $this->today =  new Today($currentTime, $workingHours, $publicHolidays, $annualLeave, $lunchTime);
    }

    /**
     * @test
     */
    public function checks()
    {
        $this->assertTrue($this->today->is(Day::THURSDAY));
        $this->assertFalse($this->today->isAssumptionDay());
        $this->assertFalse($this->today->isPublicHoliday());
        $this->assertFalse($this->today->isAfterWorkingHour());
        $this->assertFalse($this->today->isAnnualLeave());
        $this->assertFalse($this->today->isAnnunciationDay());
        $this->assertFalse($this->today->isChristmas());
        $this->assertFalse($this->today->isEpiphanyDay());
        $this->assertFalse($this->today->isLabourDay());
        $this->assertFalse($this->today->isLunchTime());
        $this->assertFalse($this->today->isMidnightOfWorkingDay());
        $this->assertFalse($this->today->isNewYearDay());
        $this->assertFalse($this->today->isNoonOfWorkingDay());
        $this->assertFalse($this->today->isWeekend());
        $this->assertTrue($this->today->isWorkingDay());
        $this->assertTrue($this->today->isWorkingHour());

        $time = new TwentyFourHourTime('08:00');
        $this->assertEquals('08:00', $time->getTime());

    }
}