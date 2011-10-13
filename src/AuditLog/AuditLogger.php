<?php

namespace spriebsch\temporalpatterns\auditlog;

class AuditLogger implements AuditLoggerInterface
{
    public function log(AuditLogMessage $message)
    {
        print $message;
    }
}
