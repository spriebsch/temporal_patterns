<?php

namespace spriebsch\temporalpatterns\snapshot;

use DateTime;

require __DIR__ . '/../src/autoload.php';

$person = new Person('Bob');
$person->setEmail('bob@example.com', new DateTime('2011-09-01'));
$person->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

$snapshot = $person->createSnapshot(new DateTime('2011-09-15'));

print 'September: ';
print $snapshot->getName() . ' <' . $snapshot->getEmail() . '>' . PHP_EOL;

$snapshot = $person->createSnapshot(new DateTime('2011-10-15'));

print 'October: ';
print $snapshot->getName() . ' <' . $snapshot->getEmail() . '>' . PHP_EOL;
