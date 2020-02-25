<?php namespace VCDM\ModelBuilder\Events\Entities;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

class CreateEntity extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "CreateEntity";
    }

    public function handle(DomainModel $domain_model)
    {
        if($this->isDataValid() && $this->isValid($domain_model)) {
            $domain_model->addEntity([
                'name' => $this->data['name'],
                'table_name' =>  $this->data['table_name'],
                'fields' => []
            ]);

            return $domain_model;
        }
    }

    public function isValid(DomainModel $domain_model)
    {
        foreach($domain_model->getEntities() as $entity) {
            if($entity['name'] == $this->data['name']) {
                return false;
            }
            if($entity['table_name'] == $this->data['table_name']) {
                return false;
            }
        }
        foreach($domain_model->getEntities() as $value_object) {
            if($value_object['table_name'] == $this->data['table_name']) {
                return false;
            }
        }

        return true;
    }

    public function isDataValid()
    {
        return (
            array_key_exists('name',$this->data) && $this->data['name'] &&
            array_key_exists('table_name',$this->data) && $this->data['table_name']
        );
    }


}