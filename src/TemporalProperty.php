<?php

require __DIR__ . '/TemporalCollection.php';

use spriebsch\datetime\DateTime;

class Person
{
    private $email;

    public function __construct()
    {
        $this->email = new TemporalCollection();
    }

    public function setEmail($email, DateTime $date = NULL)
    {
        $this->email->add($email, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {
        return $this->email->get($date);
    }
}

$bob = new Person();
$bob->setEmail('bob@example.com', new DateTime('2011-09-01'));
$bob->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

print PHP_EOL . 'Before:   ' . $bob->getEmail(new DateTime('2011-08-30'));

print PHP_EOL . 'Sep 2011: ' . $bob->getEmail(new DateTime('2011-09-05'));


print PHP_EOL . 'Oct 2011: ' . $bob->getEmail(new DateTime('2011-10-02'));

print PHP_EOL . 'Now:      ' . $bob->getEmail() . PHP_EOL;

print PHP_EOL;

