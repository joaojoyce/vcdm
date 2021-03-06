<?php namespace VCDM\ModelBuilder\Events\Entities\Fields;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

class RemoveField extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "RemoveField";
    }

    public function handle(DomainModel $domain_model)
    {
        if($this->isDataValid() && $this->isValid($domain_model)) {

            $found = -1;
            foreach($domain_model->getEntities() as $key => $entity) {
                if($entity['name'] == $this->data['entity']) {
                    $found = $key;
                }
            }

            $entity_to_change = $domain_model->getEntities()[$found];

            $new_fields = [];
            foreach($entity_to_change['fields'] as $searching_field) {
                if($searching_field['name']!=$this->data['field_name']) {
                    $new_fields[] = $searching_field;
                }
            }

            $entity_to_change['fields'] = $new_fields;

            $domain_model->removeEntity($entity_to_change['name']);
            $domain_model->addEntity($entity_to_change);

            return $domain_model;
        }
    }

    public function isValid(DomainModel $domain_model)
    {

        $found = -1;
        foreach($domain_model->getEntities() as $key => $entity) {
            if($entity['name'] == $this->data['entity']) {
                $found = $key;
            }
        }

        if($found == -1) {
            return false;
        }

        $entity_to_change = $domain_model->getEntities()[$found];

        foreach($entity_to_change['fields'] as $field) {
            if($field['name'] == $this->data['field_name']) {
                return true;
            }
        }

        return false;
    }

    public function isDataValid()
    {
        return (
            array_key_exists('entity',$this->data) && $this->data['entity'] &&
            array_key_exists('field_name',$this->data) && $this->data['field_name']
        );
    }



}