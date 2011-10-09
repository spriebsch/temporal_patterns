<?php

require __DIR__ . '/../src/DateTime.php';

use spriebsch\datetime\DateTime;

class DateTimeTest extends PHPUnit_Framework_TestCase
{
    public function testIsBeforeReturnsTrue()
    {
        $d1 = new DateTime('2011-09-01');
        $d2 = new DateTime('2011-10-01');

        $this->assertTrue($d1->isBefore($d2));
    }

    public function testIsBeforeReturnsFalse()
    {
        $d1 = new DateTime('2011-10-01');
        $d2 = new DateTime('2011-09-01');

        $this->assertFalse($d1->isBefore($d2));
    }

    public function testIsAfterReturnsTrue()
    {
        $d1 = new DateTime('2011-10-01');
        $d2 = new DateTime('2011-09-01');

        $this->assertTrue($d1->isAfter($d2));
    }

    public function testIsAfterReturnsFalse()
    {
        $d1 = new DateTime('2011-09-01');
        $d2 = new DateTime('2011-10-01');

        $this->assertFalse($d1->isAfter($d2));
    }

    public function testIsEqualReturnsTrueWhenDatesAreEqual()
    {
        $d1 = new DateTime('2011-09-01');
        $d2 = new DateTime('2011-09-01');

        $this->assertTrue($d1->isEqual($d2));
    }

    public function testIsEqualReturnsFalseWhenDatesDiffer()
    {
        $d1 = new DateTime('2011-09-01');
        $d2 = new DateTime('2011-10-01');

        $this->assertFalse($d1->isEqual($d2));
    }

    public function testIsEqualReturnsFalseForMinorDifference()
    {
        $d1 = new DateTime('2011-09-01');
        $d2 = new DateTime('2011-09-01 00:00:01');

        $this->assertFalse($d1->isEqual($d2));
    }
    
    public function testIsEqualWorksForDatesInDifferentTimezones()
    {
        $d1 = new DateTime('2011-09-01 11:00:00', new DateTimeZone('Europe/London'));
        $d2 = new DateTime('2011-09-01 12:00:00', new DateTimeZone('Europe/Berlin'));

        $this->assertTrue($d1->isEqual($d2));
    }
}
