<?php namespace VCDM\ModelBuilder\Events\ValueObjects;

use VCDM\ModelBuilder\DomainModificationEvent;

class RemoveValueObject extends DomainModificationEvent
{


    protected $event_type_version = 1;

    public function getEventType() {
        return "RemoveValueObject";
    }

}