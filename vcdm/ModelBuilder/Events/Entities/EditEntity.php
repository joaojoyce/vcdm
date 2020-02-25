<?php namespace VCDM\ModelBuilder\Events\Entities;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

class EditEntity extends DomainModificationEvent
{


    protected $event_type_version = 1;

    public function getEventType() {
        return "EditEntity";
    }

    public function handle(DomainModel $domain_model)
    {
        if($this->isDataValid() && $this->isValid($domain_model)) {
            $domain_model->editEntity($this->data['from'],$this->data['to']);
            return $domain_model;
        }
    }

    public function isValid(DomainModel $domain_model)
    {

        $current_entities = $domain_model->getEntities();

        //Check from existing model
        $key_to_remove = -1;
        foreach($current_entities as $key => $entity) {
            if($entity['name'] == $this->data['from']['name']) {
                $key_to_remove = $key;
            }
        }

        if($key_to_remove == -1) {
            return false;
        }

        unset($current_entities[$key_to_remove]);

        //Check new model is valid
        foreach($current_entities as $entity) {
            if($entity['name'] == $this->data['to']['name']) {
                return false;
            }
            if($entity['table_name'] == $this->data['to']['table_name']) {
                return false;
            }
        }

        return true;

    }

    public function isDataValid()
    {

        return (
            array_key_exists('from',$this->data) && array_key_exists('to',$this->data) &&
            array_key_exists('name',$this->data['from']) && $this->data['from']['name'] &&
            array_key_exists('name',$this->data['to']) && $this->data['to']['name'] &&
            array_key_exists('table_name',$this->data['to']) && $this->data['to']['table_name']
        );
    }


}