<?php

namespace spriebsch\temporalpatterns\temporalobject;

use DateTime;
use spriebsch\temporalpatterns\TemporalCollection;

class Person
{
    private $name;
    private $versions;

    public function __construct($name)
    {
        $this->name = $name;
        $this->versions = new TemporalCollection();
    }

    public function setEmail($email, DateTime $date = NULL)
    {
        $new = $this->getCopy();    
        $new->setEmail($email);
        $this->versions->add($new, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {    
        return $this->versions->get($date)->getEmail();
    }
    
    private function getCopy()
    {
        $current = $this->versions->get();
        if ($current == 'unknown') {
            return new PersonVersion();
        }
        
        return clone $current;
    }
}
