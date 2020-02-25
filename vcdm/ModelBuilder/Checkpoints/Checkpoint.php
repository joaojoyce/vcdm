<?php namespace VCDM\ModelBuilder\Checkpoints;


use VCDM\ModelBuilder\DomainModel;

class Checkpoint
{

    protected $event_id;

    protected $name;

    protected $domain_model;

    public function __construct($event,$name,DomainModel $domain_model) {
        $this->event_id = $event;
        $this->name = $name;
        $this->domain_model = $domain_model;
    }

    public function getEventId() {
        return $this->event_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDomainModel()
    {
        return $this->domain_model;
    }


}