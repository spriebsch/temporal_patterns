<?php

namespace spriebsch\temporalpatterns\auditlog;

interface AuditLoggerInterface
{
    public function log(AuditLogMessage $message);
}
