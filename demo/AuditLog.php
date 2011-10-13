<?php

namespace spriebsch\temporalpatterns\auditlog;

use DateTime;

require __DIR__ . '/../src/autoload.php';

$bob = new Person('Bob');
$bob->acceptAuditLogger(new AuditLogger());

$bob->setEmail('bob@example.com', new DateTime('2011-10-01 12:00:00'));

$bob->setEmail('bob@bobsdomain.com');
