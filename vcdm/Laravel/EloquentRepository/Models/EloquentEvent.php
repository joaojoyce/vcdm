<?php namespace VCDM\Laravel\EloquentRepository\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentEvent extends Model
{

    public function getTable() {
        return config('vcdm.store_table_name');
    }

}