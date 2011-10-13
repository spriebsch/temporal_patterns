<?php

namespace spriebsch\temporalpatterns\auditlog;

use DateTime;

class Person implements AuditLoggerAware
{
    private $id;
    private $email = 'unknown';
    private $auditLogger;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function acceptAuditLogger(AuditLoggerInterface $auditLogger)
    {
        $this->auditLogger = $auditLogger;
    }

    public function setEmail($email, DateTime $actualDate = NULL)
    {
        if ($actualDate === NULL) {
            $actualDate = new DateTime('now');
        }
        
        $this->log(new AuditLogMessage($actualDate, $this, 'email', $this->getEmail(), $email));
        
        $this->email = $email;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    protected function log(AuditLogMessage $message)
    {
        if ($this->auditLogger === NULL) {
            return;
        }

        $this->auditLogger->log($message);
    }
}
