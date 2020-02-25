<?php namespace VCDM\ModelBuilder\Events\Fields;

use VCDM\ModelBuilder\DomainModificationEvent;

class EditField extends DomainModificationEvent
{
    
    protected $event_type_version = 1;

    public function getEventType() {
        return "EditField";
    }

}