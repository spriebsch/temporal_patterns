<?php

class CustomerVersion
{
    private $email;
    private $address;
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
}

class Address
{
}

class Customer
{
    private $versions;

    public function __construct()
    {
        $this->versions = new SplObjectStorage();
    }

    public function setEmail($email, DateTime $date = NULL)
    {
        if ($date === NULL) {
            $date = new DateTime('now');
        }

        $this->email[$date] = $email;
    }

    public function getEmail(DateTime $date = NULL)
    {
        if ($date === NULL) {
            $date = new DateTime('now');
        }
             
        // Search backwards to find "latest" before-date first
        foreach (array_reverse(iterator_to_array($this->email)) as $d) {
            // "if date > $d"
            if ($date->diff($d)->invert) {
                return $this->email[$d];
            }
        }
    
        return 'unknown';
    }
}

$bob = new Customer();
$bob->setEmail('bob@example.com', new DateTime('2011-09-01'));
$bob->setEmail('bob@bobsdomain.com', new DateTime('2011-10-01'));

print PHP_EOL . 'Before:    ' . $bob->getEmail(new DateTime('2011-08-30'));

print PHP_EOL . 'Sept 2011: ' . $bob->getEmail(new DateTime('2011-09-05'));


print PHP_EOL . 'Oct 2011:  ' . $bob->getEmail(new DateTime('2011-10-02'));

print PHP_EOL . 'Now:       ' . $bob->getEmail() . PHP_EOL;

print PHP_EOL;
