<?php namespace VCDM\ModelBuilder\Events\Relationships;

use VCDM\ModelBuilder\DomainModificationEvent;

class EditRelationship extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "EditRelationship";
    }

}