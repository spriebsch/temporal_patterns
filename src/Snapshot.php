<?php

require __DIR__ . '/TemporalCollection.php';

use spriebsch\datetime\DateTime;

class SnapshotPerson
{
    private $name;
    private $email;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->email = new TemporalCollection();
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setEmail($email, DateTime $date = NULL)
    {
        $this->email->add($email, $date);
    }

    public function getEmail(DateTime $date = NULL)
    {
        return $this->email->get($date);
    }

    public function createSnapshot(DateTime $date)
    {
        return new PersonSnapshot($this, $date);
    }
}

class PersonSnapshot
{
    private $date;
    private $person;

    public function __construct(Person $person, DateTime $date)
    {
        $this->date = $date;
        $this->person = $person;
    }
    
    public function getName()
    {
        return $this->person->getName();
    }
    
    public function getEmail()
    {
        return $this->person->getEmail($this->date);
    }
}

$person = new SnapshotPerson('Bob');
$person->setEmail('bob@example.com', new DateTime('2011-09-01'));
$person->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

$snapshot = $person->createSnapshot(new DateTime('2011-09-15'));

print 'September: ';
print $snapshot->getName() . ' <' . $snapshot->getEmail() . '>' . PHP_EOL;

$snapshot = $person->createSnapshot(new DateTime('2011-10-15'));

print 'October: ';
print $snapshot->getName() . ' <' . $snapshot->getEmail() . '>' . PHP_EOL;
