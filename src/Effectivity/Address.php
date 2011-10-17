<?php

namespace spriebsch\temporalpatterns\effectivity;

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
