<?php namespace VCDM\ModelBuilder\Events\Fields;

use VCDM\ModelBuilder\DomainModificationEvent;

class RemoveField extends DomainModificationEvent
{

    protected static $event_type = "RemoveField";

    protected $event_type_version = 1;

    public function getEventType() {
        return "RemoveField";
    }

}