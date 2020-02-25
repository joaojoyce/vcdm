<?php namespace VCDM\ModelBuilder;

class DomainModel
{

    private $entities;

    private $value_objects;

    private $relationships;

    public function __construct($entities,$value_objects,$relationships) {
        $this->entities = $entities;
        $this->value_objects = $value_objects;
        $this->relationships = $relationships;
    }

    public function getEntities() {
        return $this->entities;
    }

    public function getValueObjects() {
        return $this->value_objects;
    }

    public function getRelationships() {
        return $this->relationships;
    }

    public function addEntity($entity) {
        $this->entities[] = $entity;
    }

    public function addValueObject($value_object) {
        $this->value_objects[] = $value_object;
    }

    public function addRelationships($relationship) {
        $this->relationships[] = $relationship;
    }

}