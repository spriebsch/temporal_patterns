<?php

namespace spriebsch\datetime;

class DateTime extends \DateTime
{
    public function isBefore($date)
    {
        return (bool) $date->diff($this)->invert;
    }

    public function isAfter($date)
    {
        return !$this->isBefore($date);
    }
    
    public function isEqual($date)
    {
        $diff = $date->diff($this);

        return $diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0;
    }
}
