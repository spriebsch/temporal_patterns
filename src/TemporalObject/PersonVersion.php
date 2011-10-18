<?php

namespace spriebsch\temporalpatterns\temporalobject;

class PersonVersion
{
    private $email;

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
}
