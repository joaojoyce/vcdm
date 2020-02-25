<?php namespace VCDM\ModelBuilder\Exceptions;

use VCDM\ModelBuilder\DomainModificationEvent;

class DomainModificationEventException extends \Exception
{

    public function __construct(DomainModificationEvent $event)
    {
        parent::__construct("DomainModificationException: ". $event->getEventType() . " Data: ". json_encode($event->getData(),true), 500);
    }

}