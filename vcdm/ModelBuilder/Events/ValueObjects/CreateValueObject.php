<?php namespace VCDM\ModelBuilder\Events\ValueObjects;

use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\DomainModificationEvent;

class CreateValueObject extends DomainModificationEvent
{

    protected $event_type_version = 1;

    public function getEventType() {
        return "CreateValueObject";
    }

    public function handle(DomainModel $domain_model)
    {
        if($this->isDataValid($domain_model) && $this->isValid($domain_model)) {
            $domain_model->addValueObject([
                'name' => $this->data['name'],
                'table_name' =>  $this->data['table_name']
            ]);



            return $domain_model;
        }
    }

    public function isValid(DomainModel $domain_model)
    {
        foreach($domain_model->getValueObjects() as $value_object) {
            if($value_object['name'] == $this->data['name']) {
                return false;
            }
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