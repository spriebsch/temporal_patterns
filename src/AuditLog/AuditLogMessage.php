<?php

namespace spriebsch\temporalpatterns\auditlog;

use DateTime;

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
