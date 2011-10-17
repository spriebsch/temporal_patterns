<?php

namespace spriebsch\temporalpatterns\effectivity;

use DateTime;

require __DIR__ . '/../src/autoload.php';

$person = new Person('Bob');
$person->addAddress(new Address('San Francisco'), new DateTime('2011-01-01'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}

$person->addAddress(new Address('Los Angeles'), new DateTime('2011-06-01'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}

$addresses = $person->getAddresses();
$address = $addresses[0];
$address->endEffectivity(new DateTime('2011-05-31'));

print PHP_EOL . 'Bob\'s addresses in July 2011:' . PHP_EOL;

$date = new DateTime('2011-07-01');
$addresses = $person->getAddresses();
foreach ($addresses as $address) {
    if ($address->isEffectiveOn($date)) {
        print '- ' . $address->getAddress() . PHP_EOL;
    }
}
