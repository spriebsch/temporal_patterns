<?php

require __DIR__ . '/DateTime.php';

use spriebsch\datetime\DateTime;

class TemporalCollection
{
    protected $items;
    protected $dates;
    
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
            if ($a->isEqual($b)) {
                return 0;
            }

            if ($a->isBefore($b)) {
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
            if ($date->isAfter($d) || $date->isEqual($d)) {
                return $this->items[$d];
            }
        }

        return 'unknown';
    }
}

class Customer
{
    private $email;

    public function __construct()
    {
        $this->email = new TemporalCollection();
    }

    public function setEmail($email, DateTime $date = NULL)
    {
        $this->email->add($email, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {
        return $this->email->get($date);
    }
}

$bob = new Customer();
$bob->setEmail('bob@example.com', new DateTime('2011-09-01'));
$bob->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

print PHP_EOL . 'Before:   ' . $bob->getEmail(new DateTime('2011-08-30'));

print PHP_EOL . 'Sep 2011: ' . $bob->getEmail(new DateTime('2011-09-05'));


print PHP_EOL . 'Oct 2011: ' . $bob->getEmail(new DateTime('2011-10-02'));

print PHP_EOL . 'Now:      ' . $bob->getEmail() . PHP_EOL;

print PHP_EOL;

