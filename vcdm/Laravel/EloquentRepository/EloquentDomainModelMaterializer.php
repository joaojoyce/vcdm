<?php namespace VCDM\Laravel\EloquentRepository;

use VCDM\ModelBuilder\DomainModificationEvent;
use VCDM\ModelBuilder\Repository\DomainModelMaterializer;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class EloquentDomainModelMaterializer implements DomainModelMaterializer
{


    public function handleEvent(DomainModificationEvent $event) {
        if($event->getEventType() == 'CreateValueObject') {
            \Schema::create($event->getData()['table_name'], function (Blueprint $table) {
                $table->string('_vcdm_placeholder');
            });
        }
    }

}