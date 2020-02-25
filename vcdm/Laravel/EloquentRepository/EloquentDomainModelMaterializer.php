<?php namespace VCDM\Laravel\EloquentRepository;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;
use VCDM\ModelBuilder\Repository\DomainModelMaterializer;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class EloquentDomainModelMaterializer implements DomainModelMaterializer
{


    public function handleEvent(DomainModel $domain_model, DomainModificationEvent $event) {

        if($event->getEventType() == 'CreateEntity') {
            \Schema::create($event->getData()['table_name'], function (Blueprint $table) {
                $table->increments('id');
            });
            return;
        }

        if($event->getEventType() == 'RemoveEntity') {
            $from = null;
            foreach($domain_model->getEntities() as $entity) {
                if($entity['name'] == $event->getData()['name']) {
                    $from = $entity;
                }
            }


            \Schema::drop($from['table_name']);
            return;
        }

        if($event->getEventType() == 'EditEntity') {

            $from = null;
            foreach($domain_model->getEntities() as $entity) {
                if($entity['name'] == $event->getData()['from']['name']) {
                    $from = $entity;
                }
            }

            //Only rename if new table_name is different...
            if($from['table_name'] != $event->getData()['to']['table_name']) {
                \Schema::rename($from['table_name'], $event->getData()['to']['table_name']);
            }
            return;
        }


        if($event->getEventType() == 'AddField') {

            $from = null;
            foreach($domain_model->getEntities() as $entity) {
                if($entity['name'] == $event->getData()['entity']) {
                    $from = $entity;
                }
            }

            \Schema::table($from['table_name'], function (Blueprint $table) use ($event) {
                $table->string($event->getData()['field_name']);
            });

            return;
        }

        if($event->getEventType() == 'RemoveField') {

            $from = null;
            foreach($domain_model->getEntities() as $entity) {
                if($entity['name'] == $event->getData()['entity']) {
                    $from = $entity;
                }
            }

            \Schema::table($from['table_name'], function (Blueprint $table) use ($event) {
                $table->dropColumn($event->getData()['field_name']);
            });

            return;
        }


    }

}