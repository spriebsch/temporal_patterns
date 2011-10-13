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
    
    public function getAddresses()
    {
        return $this->addresses;
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
    
    public function __toString()
    {
        return $this->address;
    }
}

class AddressEffectivity
{
    const FOREVER = '2999-12-31';

    private $address;
    private $effectivityRange;
    
    public function __construct(Address $address, DateTime $start)
    {
        $this->address = $address;
        $this->effectivityRange = new DateRange($start, new DateTime(self::FOREVER));
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function endEffectivity(DateTime $end)
    {
//        $this->effictivityRange = new DateRange($this->effectivityRange->getStart(), $end);
        $this->effectivityRange = new DateRange($this->effectivityRange->getStart(), $end);
    }
    
    public function setEffectivity(DateRange $range)
    {
        $this->effectivityRange = $range;
    }
    
    public function isEffectiveOn(DateTime $date)
    {
        return $this->effectivityRange->includes($date);
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
               ($date->isBefore($this->end) || $date->isEqual($this->end));
    }
}

$person = new Person('Bob');
$person->addAddress(new Address('San Francisco'), new DateTime('2011-01-01'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}

$person->addAddress(new Address('Los Angeles'), new DateTime('2011-06-01'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}

$addresses = $person->getAddresses();
$address = $addresses[0];
$address->endEffectivity(new DateTime('2011-05-31'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}
