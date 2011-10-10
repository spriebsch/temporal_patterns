<?php

require __DIR__ . '/DateTime.php';

use spriebsch\datetime\DateTime;

class Person
{
    private $name;
    private $addresses = array();

    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function addAddress(Address $address, DateTime $start)
    {
        $this->addresses[] = new AddressEffectivity($address, $start);
    }
    
    public function endEffectivity(Address $address, DateTime $end)
    {
        $addressEffectivity = NULL;
    
        foreach ($this->addresses as $a) {
            if ($address == $a->getAddress()) {
                $addressEffectivity = $a;
            }
        }
        
        if ($addressEffectivity == NULL) {
            throw new Exception('Unknown address');
        }
    
        return $addressEffectivity->end($end);
    }
}

class Address
{
    private $address;

    public function __construct($address)
    {
        $this->address = $address;
    }
}

class AddressEffectivity
{
    private $address;
    private $effectivityRange;
    
    public function __construct(Address $address, DateTime $start)
    {
        $this->address = $address;
        $this->effectivityRange = new DateRange($start, new DateTime('2999-12-31'));
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function end(DateTime $end)
    {
        $this->effictivityRange = new DateRange($this->effectivityRange->getStart(), $end);
    }
    
    public function setEffectivity(DateRange $range)
    {
        $this->effectivityRange = $range;
    }
    
    public function isEffectiveOn(DateTime $date)
    {
        return $this->range->includes($date);
    }
}


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
        return ($date->isAfter($this->start) || $date->isEqual($this->start)) &&
               ($date->isBefore($this->end) || $date->isEqual($this->start));
    }
}

$address1 = new Address('the first address');
$address2 = new Address('the second address');

$person = new Person('Bob');
$person->addAddress($address1, new DateTime('2011-01-01'));
$person->addAddress($address2, new DateTime('2011-06-01'));

$person->endEffectivity($address1, new DateTime('2011-05-30'));

var_dump($person);
