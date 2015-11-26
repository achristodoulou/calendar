# Calendar

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Software License][ico-license]](LICENSE.md)

This package can be used for any calendar related queries. For example you can check if today is a specific date, 
if is public holidays, is working day, is working hours, is lunch time, is Christmas any many more.

## Install

Via Composer

``` bash
$ composer require achristodoulou/calendar
```

## Usage

``` php
use \Achristodoulou\Calendar\Day;
use \Achristodoulou\Calendar\ListOfDates;
use \Achristodoulou\Calendar\TimeRange;
use \Achristodoulou\Calendar\TwentyFourHourTime;
use \Achristodoulou\Calendar\Today;

$currentTime = new DateTime();

$workingHours = new TimeRange(new TwentyFourHourTime('08:00'), new TwentyFourHourTime('18:00'));

$publicHolidays = new ListOfDates();
$publicHolidays->add(new DateTime('2015-01-18'));

$annualLeave = new ListOfDates();
$annualLeave->add(new DateTime('2015-07-30'));

$lunchTime = new TimeRange(new TwentyFourHourTime('12:00'), new TwentyFourHourTime('01:00'));

$today = new Today($currentTime, $workingHours, $publicHolidays, $annualLeave, $lunchTime);

echo "\nToday is Thursday: "                . ($today->is(Day::THURSDAY)          ? 'yes' : 'no');
echo "\nToday is Assumption Day: "          . ($today->isAssumptionDay()          ? 'yes' : 'no');
echo "\nToday is Public Holiday: "          . ($today->isPublicHoliday()          ? 'yes' : 'no');
echo "\nNow is After Working Hours: "       . ($today->isAfterWorkingHour()       ? 'yes' : 'no');
echo "\nToday I am on Annual Leave: "       . ($today->isAnnualLeave()            ? 'yes' : 'no');
echo "\nToday is Annunciation Day: "        . ($today->isAnnunciationDay()        ? 'yes' : 'no');
echo "\nToday is Christmas Day: "           . ($today->isChristmas()              ? 'yes' : 'no');
echo "\nToday is Epiphany Day: "            . ($today->isEpiphanyDay()            ? 'yes' : 'no');
echo "\nToday is Labour Day: "              . ($today->isLabourDay()              ? 'yes' : 'no');
echo "\nNow is Lunch Time: "                . ($today->isLunchTime()              ? 'yes' : 'no');
echo "\nToday is Midnight Of Working Day: " . ($today->isMidnightOfWorkingDay()   ? 'yes' : 'no');
echo "\nToday is New Year Day: "            . ($today->isNewYearDay()             ? 'yes' : 'no');
echo "\nToday is Noon of Working Day: "     . ($today->isNoonOfWorkingDay()       ? 'yes' : 'no');
echo "\nToday is Weekend: "                 . ($today->isWeekend()                ? 'yes' : 'no');
echo "\nToday is Working Day: "             . ($today->isWorkingDay()             ? 'yes' : 'no');
echo "\nNow is Working Hour: "              . ($today->isWorkingHour()            ? 'yes' : 'no');
```

Output:
```
Today is Thursday: yes
Today is Assumption Day: no
Today is Public Holiday: no
Now is After Working Hours: yes
Today I am on Annual Leave: no
Today is Annunciation Day: no
Today is Christmas Day: no
Today is Epiphany Day: no
Today is Labour Day: no
Now is Lunch Time: no
Today is Midnight Of Working Day: no
Today is New Year Day: no
Today is Noon of Working Day: no
Today is Weekend: no
Today is Working Day: yes
Now is Working Hour: no
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Andreas Christodoulou]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/achristodoulou/calendar.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/achristodoulou/calendar/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/achristodoulou/calendar.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/achristodoulou/calendar
[link-travis]: https://travis-ci.org/achristodoulou/calendar
[link-contributors]: ../../contributors
[link-author]: https://github.com/achristodoulou
[link-downloads]: https://packagist.org/packages/achristodoulou/calendar