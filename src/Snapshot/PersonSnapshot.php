<?php

namespace spriebsch\temporalpatterns\snapshot;

use DateTime;

class PersonSnapshot
{
    private $date;
    private $person;

    public function __construct(Person $person, DateTime $date)
    {
        $this->date = $date;
        $this->person = $person;
    }
    
    public function getName()
    {
        return $this->person->getName();
    }
    
    public function getEmail()
    {
        return $this->person->getEmail($this->date);
    }
}
