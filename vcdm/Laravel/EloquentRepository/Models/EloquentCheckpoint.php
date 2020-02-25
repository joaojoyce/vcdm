<?php namespace VCDM\Laravel\EloquentRepository\Models;

use Illuminate\Database\Eloquent\Model;
use VCDM\ModelBuilder\DomainModel;

class EloquentCheckpoint extends Model
{

    public function getTable() {
        return config('vcdm.checkpoint_table_name');
    }

    public function setDomainModelAttribute(DomainModel $domainModel) {
        $this->attributes['domain_model'] = json_encode([
            'entities' => $domainModel->getEntities(),
            'value_objects' => $domainModel->getValueObjects(),
            'relationships' => $domainModel->getRelationships()
        ],true);
    }

    public function getDomainModelAttribute($value) {
        $domain_array = json_decode($value,true);
        return new DomainModel($domain_array['entities'],$domain_array['value_objects'],$domain_array['relationships']);
    }



}