<?php namespace VCDM\ModelBuilder\Exceptions;

class DomainCheckpointException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct("Checkpoint Exception: " . $message, 500);
    }

}