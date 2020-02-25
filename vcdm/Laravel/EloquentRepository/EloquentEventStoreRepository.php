<?php namespace VCDM\Laravel\EloquentRepository;

use VCDM\Laravel\EloquentRepository\Models\EloquentEvent;
use VCDM\ModelBuilder\DomainModificationEvent;
use VCDM\ModelBuilder\Repository\EventStoreRepository;

class EloquentEventStoreRepository implements EventStoreRepository
{


    public function storeEvent(DomainModificationEvent $event)
    {

        $event_to_store = new EloquentEvent();
        $event_to_store->event = $event->serialize();
        $event_to_store->save();
        return $event_to_store->id;
    }

}