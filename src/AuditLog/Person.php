<?php

namespace spriebsch\temporalpatterns\auditlog;

use DateTime;

class Person extends DomainObject implements AuditLoggerAware
{
    private $email = 'unknown';

    public function setEmail($email, DateTime $actualDate = NULL)
    {
        if ($actualDate === NULL) {
            $actualDate = new DateTime('now');
        }
        
        $this->log(new AuditLogMessage($actualDate, $this, 'email', $this->getEmail(), $email));
        
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
}
