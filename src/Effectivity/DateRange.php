<?php

namespace spriebsch\temporalpatterns\effectivity;

use DateTime;

class DateRange
{
    private $start;
    private $end;

    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
    
    public function includes(DateTime $date)
    {
        return ($date > $this->start || $date == $this->start) &&
               ($date < $this->end   || $date == $this->end);
    }
}
