<?php namespace VCDM\ModelBuilder\Repository;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

interface DomainModelMaterializer
{

    public function handleEvent(DomainModel$domain_model, DomainModificationEvent $event);

}