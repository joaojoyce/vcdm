<?php namespace VCDM\ModelBuilder\Events\Fields;

use VCDM\ModelBuilder\DomainModificationEvent;

class CreateField extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "CreateField";
    }

}