<?php

namespace spriebsch\temporalpatterns\snapshot;

use DateTime;
use spriebsch\temporalpatterns\TemporalCollection;

class Person
{
    private $name;
    private $email;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->email = new TemporalCollection();
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setEmail($email, DateTime $date = NULL)
    {
        $this->email->add($email, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {
        return $this->email->get($date);
    }

    public function createSnapshot(DateTime $date)
    {
        return new PersonSnapshot($this, $date);
    }
}
