<?php

namespace spriebsch\temporalpatterns\effectivity;

use DateTime;

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
