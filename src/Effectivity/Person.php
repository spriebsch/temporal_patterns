<?php

namespace spriebsch\temporalpatterns\effectivity;

use DateTime;

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
