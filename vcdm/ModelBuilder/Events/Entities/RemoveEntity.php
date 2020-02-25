<?php namespace VCDM\ModelBuilder\Events\Entities;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

class RemoveEntity extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "RemoveEntity";
    }

    public function handle(DomainModel $domain_model)
    {
        if($this->isDataValid() && $this->isValid($domain_model)) {
            $domain_model->removeEntity($this->data['name']);
            return $domain_model;
        }
    }

    public function isValid(DomainModel $domain_model)
    {
        foreach($domain_model->getEntities() as $entity) {
            if($entity['name'] == $this->data['name']) {
                return true;
            }
        }

        return false;
    }

    public function isDataValid()
    {
        return (
            array_key_exists('name',$this->data) && $this->data['name']
        );
    }

}