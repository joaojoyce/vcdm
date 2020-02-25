<?php namespace VCDM\ModelBuilder\Repository;

use VCDM\ModelBuilder\DomainModificationEvent;
use VCDM\ModelBuilder\VirtualDomainModel;

interface EventStoreRepository
{

    /**
     * @param DomainModificationEvent $event
     * @return integer $event_id
     */
    public function storeEvent(DomainModificationEvent $event);


}