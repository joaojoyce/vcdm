<?php namespace VCDM\ModelBuilder;

abstract class DomainModificationEvent
{

    /**
     * @var string
     */
    protected $event_type_version;

    /**
     * @var array
     */
    protected  $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public abstract function getEventType();

    public function serialize() {
        return json_encode([
            'event_type' => $this->getEventType(),
            'event_type_version' => $this->event_type_version,
            'data' => json_encode($this->data)
        ]);
    }

    public function handle(DomainModel $domain_model)
    {
        return $domain_model;
    }

    public function isValid(DomainModel $domain_model)
    {
        return false;
    }

    public function isDataValid() {
        return false;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

}