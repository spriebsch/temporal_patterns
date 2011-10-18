<?php

namespace spriebsch\temporalpatterns\temporalproperty;

use DateTime;
use spriebsch\temporalpatterns\TemporalCollection;

class Person
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
