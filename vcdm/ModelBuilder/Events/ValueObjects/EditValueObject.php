<?php namespace VCDM\ModelBuilder\Events\ValueObjects;

use VCDM\ModelBuilder\DomainModificationEvent;

class EditValueObject extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "EditValueObject";
    }


}