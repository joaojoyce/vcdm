<?php namespace VCDM\Laravel\Facade;

use Illuminate\Support\Facades\Facade;

class DomainModificationStream extends Facade
{

    protected static function getFacadeAccessor() { return 'VCDM\ModelBuilder\DomainModificationStream'; }

}