<?php namespace VCDM\ModelBuilder\Events\Entities;

use VCDM\ModelBuilder\DomainModificationEvent;

class RemoveEntity extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "RemoveEntity";
    }

}