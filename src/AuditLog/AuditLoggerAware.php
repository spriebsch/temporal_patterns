<?php

namespace spriebsch\temporalpatterns\auditlog;

interface AuditLoggerAware
{
    public function acceptAuditLogger(AuditLoggerInterface $logger);
}
