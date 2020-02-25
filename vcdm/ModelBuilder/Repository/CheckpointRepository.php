<?php namespace VCDM\ModelBuilder\Repository;

use VCDM\ModelBuilder\Checkpoints\Checkpoint;
use VCDM\ModelBuilder\DomainModel;

interface CheckpointRepository
{

    public function storeCheckpoint(Checkpoint $check, DomainModel $domain_model);

    public function getCheckpoint($name);

    public function getLastCheckpoint();

    public function checkpointNameIsValid($name);

}