<?php namespace VCDM\ModelBuilder;

use VCDM\ModelBuilder\Checkpoints\Checkpoint;
use VCDM\ModelBuilder\Exceptions\DomainCheckpointException;
use VCDM\ModelBuilder\Exceptions\DomainModificationEventException;
use VCDM\ModelBuilder\Repository\CheckpointRepository;
use VCDM\ModelBuilder\Repository\DomainModelMaterializer;
use VCDM\ModelBuilder\Repository\EventStoreRepository;

class DomainModificationStream
{

    protected $events;

    protected $from_event;

    public function __construct(EventStoreRepository $event_store_repository, CheckpointRepository $checkpoint_repository, DomainModelMaterializer $domain_model_materializer)
    {
        $this->event_store_repository = $event_store_repository;
        $this->checkpoint_repository = $checkpoint_repository;
        $this->domain_model_materializer = $domain_model_materializer;
    }

    public function commit($event_array,$name) {

        $event_id=null;

        /** @var Checkpoint $checkpoint */
        $checkpoint = $this->checkpoint_repository->getLastCheckpoint();

        if($checkpoint) {
            $domain_model = $checkpoint->getDomainModel();
        } else {
            $domain_model = new DomainModel([],[]);
        }

        $this->checkEventValidity($domain_model,$event_array);
        $this->checkCheckpointValidity($name);

        /** @var DomainModificationEvent $event */
        foreach($event_array as $event) {
            $this->domain_model_materializer->handleEvent($domain_model,$event);

            $domain_model = $event->handle($domain_model);
            $event_id = $this->event_store_repository->storeEvent($event);
        }

        if($event_id) {
            $checkpoint = new Checkpoint($event_id,$name,$domain_model);
            return $this->checkpoint_repository->storeCheckpoint($checkpoint, $domain_model);
        }

    }

    private function checkEventValidity($domain_model, $event_array)
    {

        $new_model = clone $domain_model;

        /** @var DomainModificationEvent $event */
        foreach($event_array as $event) {
            if(!$event->isDataValid() || !$event->isValid($new_model)) {
                throw new DomainModificationEventException($event);
            } else {
                $new_model = $event->handle($new_model);
            }
        }
    }

    private function checkCheckpointValidity($name)
    {
        if(!$this->checkpoint_repository->checkpointNameIsValid($name)) {
            throw new DomainCheckpointException("Checkpoint name not valid!");
        }
    }


}