<?php

namespace spriebsch\temporalpatterns\auditlog;

class DomainObject implements AuditLoggerAware
{
    private $id;
    private $auditLogger;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function acceptAuditLogger(AuditLoggerInterface $auditLogger)
    {
        $this->auditLogger = $auditLogger;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    protected function log(AuditLogMessage $message)
    {
        if ($this->auditLogger === NULL) {
            return;
        }

        $this->auditLogger->log($message);
    }
}
