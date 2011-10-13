<?php

require __DIR__ . '/src/autoload.php';

class Customer
{
    private $id;
    private $email = 'unknown';

    protected $logger;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setEmail($email, DateTime $changeDate = NULL)
    {
        if ($changeDate === NULL) {
            $changeDate = new DateTime('now');
        }
        
        $this->log(new AuditLogMessage($changeDate, $this, 'email', $this->getEmail(), $email));
        
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function acceptAuditLogger(AuditLogger $logger)
    {
        $this->logger = $logger;
    }

    protected function log(AuditLogMessage $message)
    {
        if ($this->logger === NULL) {
            return;
        }

        $this->logger->log($message);
    }
}

class AuditLogMessage
{
    protected $date;
    protected $changeDate;
    protected $object;
    protected $attributeName;
    protected $oldValue;
    protected $newValue;

    public function __construct($changeDate, $object, $attributeName, $oldValue, $newValue)
    {
        $this->date = new DateTime('now');
        $this->changeDate = $changeDate;
        $this->object = $object;
        $this->attributeName = $attributeName;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
    
    public function __toString()
    {
        return $this->date->format('r') . ': Changed ' . $this->attributeName .
               ' of ' . get_class($this->object) . ' ' . $this->object->getId() .
               ' from "' . $this->oldValue . '" to "' . $this->newValue .
               '" on ' . $this->changeDate->format('r') . PHP_EOL;
    }
}

class AuditLogger
{
    public function log(AuditLogMessage $message)
    {
        print $message;
    }
}

$bob = new Customer('Bob');
$bob->acceptAuditLogger(new AuditLogger());

$bob->setEmail('bob@example.com', new DateTime('2011-10-01 12:00:00'));

$bob->setEmail('bob@bobsdomain.com');
