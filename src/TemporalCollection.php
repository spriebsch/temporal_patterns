<?php

namespace spriebsch\temporalpatterns;

use DateTime;
use SplObjectStorage;

class TemporalCollection
{
    protected $items;
    protected $dates = array();
    
    public function __construct()
    {
        $this->items = new SplObjectStorage();
    }

    public function add($item, DateTime $date = NULL)
    {
        if ($date === NULL) {
            $date = new DateTime('now');
        }
        
        $this->items[$date] = $item;
        $this->dates[] = $date;

        // sort in descending order
        usort($this->dates, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }

            if ($a < $b) {
                return 1;
            }
                    
            return -1;
        });
    }

    public function get(DateTime $date = NULL)
    {    
        if ($date === NULL) {
            $date = new DateTime('now');
        }

        foreach ($this->dates as $d) {
            if ($date > $d || $date == $d) {
                return $this->items[$d];
            }
        }

        return 'unknown';
    }
}
