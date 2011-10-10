<?php

require __DIR__ . '/TemporalCollection.php';

use spriebsch\datetime\DateTime;

class PersonVersion
{
    private $email;

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
}

class Person
{
    private $name;
    private $versions;

    public function __construct($name)
    {
        $this->name = $name;
        $this->versions = new TemporalCollection();
    }

    public function setEmail($email, DateTime $date = NULL)
    {
        $new = $this->getCopy();    
        $new->setEmail($email);
        $this->versions->add($new, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {    
        return $this->versions->get($date)->getEmail();
    }
    
    private function getCopy()
    {
        $current = $this->versions->get();
        if ($current == 'unknown') {
            return new PersonVersion();
        }
        
        return clone $current;
    }
}

$bob = new Person('Bob');
$bob->setEmail('bob@example.com', new DateTime('2011-09-01'));
$bob->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

print PHP_EOL . 'Sep 2011: ' . $bob->getEmail(new DateTime('2011-09-05'));
print PHP_EOL . 'Oct 2011: ' . $bob->getEmail(new DateTime('2011-10-02'));

print PHP_EOL;
