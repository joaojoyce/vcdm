<?php namespace VCDM\ModelBuilder;

class DomainModel
{

    private $entities;


    private $relationships;

    public function __construct($entities,$relationships) {
        $this->entities = $entities;
        $this->relationships = $relationships;
    }

    public function getEntities() {
        return $this->entities;
    }

    public function getRelationships() {
        return $this->relationships;
    }


    public function addRelationships($relationship) {
        $this->relationships[] = $relationship;
    }

    public function addEntity($entity) {
        $this->entities[] = $entity;
    }

    public function removeEntity($name)
    {
        $new_entities = [];
        foreach($this->entities as $entity) {
            if($entity['name'] != $name) {
                $new_entities[] = $entity;
            }
        }
        $this->entities = $new_entities;
    }

    public function editEntity($from, $to)
    {
        $new_entities = [];
        foreach($this->entities as $entity) {
            if($entity['name'] != $from['name']) {
                $new_entities[] = $entity;
            } else {
                $new_entities[] = $to;
            }
        }
        $this->entities = $new_entities;

    }

}