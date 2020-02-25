<?php namespace VCDM\Laravel\EloquentRepository;

use VCDM\Laravel\EloquentRepository\Models\EloquentCheckpoint;
use VCDM\ModelBuilder\Checkpoints\Checkpoint;
use VCDM\ModelBuilder\DomainModel;
use VCDM\ModelBuilder\Repository\CheckpointRepository;

class EloquentCheckpointRepository implements CheckpointRepository
{

    public function storeCheckpoint(Checkpoint $checkpoint, DomainModel $domain_model)
    {
        $checkpoint_to_store = new EloquentCheckpoint();
        $checkpoint_to_store->event_id = $checkpoint->getEventId();
        $checkpoint_to_store->name = $checkpoint->getName();
        $checkpoint_to_store->domain_model = $checkpoint->getDomainModel();
        $checkpoint_to_store->save();
        return $checkpoint_to_store->id;

    }

    public function getCheckpoint($name)
    {
        $checkpoint_from_store = EloquentCheckpoint::where('name','=',$name)->first();
        if($checkpoint_from_store) {
            return new Checkpoint($checkpoint_from_store->event,$checkpoint_from_store->name,$checkpoint_from_store->domain_model);
        }
    }

    public function getLastCheckpoint() {
        $eloquent_checkpoint = EloquentCheckpoint::orderBy('id','desc')->first();
        if($eloquent_checkpoint) {
            return new Checkpoint($eloquent_checkpoint->event,$eloquent_checkpoint->name,$eloquent_checkpoint->domain_model);
        } else {
            return null;
        }
    }

    public function checkpointNameIsValid($name) {
        $eloquent_checkpoint = EloquentCheckpoint::where('name','=',$name)->first();
        if($eloquent_checkpoint) {
            return false;
        } else {
            return true;
        }
    }



}