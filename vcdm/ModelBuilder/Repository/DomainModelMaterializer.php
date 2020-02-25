<?php namespace VCDM\ModelBuilder\Repository;

use VCDM\ModelBuilder\DomainModificationEvent;

interface DomainModelMaterializer
{

    public function handleEvent(DomainModificationEvent $event);

}