<?php

namespace Goodby\ImmutableDatetime\Tests\Unit;

use Goodby\ImmutableDatetime\DateTime;

class UsageExampleTest extends \PHPUnit_Framework_TestCase
{
    private $defaultTimezone;

    protected function setUp()
    {
        $this->defaultTimezone = date_default_timezone_get();
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->defaultTimezone);
    }

    public function test_Construct_with_current_timestamp()
    {
        $datetime = new DateTime();

        $this->assertSame(time(), $datetime->timestamp());
    }

    public function test_Construct_specifying_timestamp()
    {
        date_default_timezone_set('Asia/Tokyo');

        $datetime = new DateTime(999994149);
        $this->assertSame(999994149, $datetime->timestamp());
        $this->assertSame('2001-09-09 09:09:09', $datetime->format('Y-m-d H:i:s'));
    }

    public function test_Date_time_comparison()
    {
        $aDatetime = new DateTime(1);
        $anotherDatetime = new DateTime(2);

        $this->assertTrue($aDatetime->before($anotherDatetime));
        $this->assertTrue($anotherDatetime->after($aDatetime));

        $this->assertFalse($aDatetime->after($anotherDatetime));
        $this->assertFalse($anotherDatetime->before($anotherDatetime));

        $this->assertFalse($aDatetime->equals($anotherDatetime));
        $this->assertFalse($anotherDatetime->equals($aDatetime));
    }

    public function test_Date_time_compare_same_timestamp()
    {
        $aDatetime = new DateTime(0);

        // before() and after() return FALSE because,
        // they compare with '>' or '<' but not '>=' or '<='
        $this->assertFalse($aDatetime->before($aDatetime));
        $this->assertFalse($aDatetime->after($aDatetime));

        $this->assertTrue($aDatetime->equals($aDatetime));
    }
}
