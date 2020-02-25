<?php namespace VCDM\Laravel;

use Illuminate\Support\ServiceProvider;
use VCDM\Laravel\EloquentRepository\EloquentCheckpointRepository;
use VCDM\Laravel\EloquentRepository\EloquentDomainModelMaterializer;
use VCDM\Laravel\EloquentRepository\EloquentEventStoreRepository;
use VCDM\ModelBuilder\DomainModificationStream;

class VcdmServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/Laravel/config/vcdm.php', 'vcdm');

        //Binding interfaces
        $this->app->singleton(\VCDM\ModelBuilder\Repository\EventStoreRepository::class, function ($app) {
            return new EloquentEventStoreRepository();
        });
        $this->app->singleton(\VCDM\ModelBuilder\Repository\CheckpointRepository::class, function ($app) {
            return new EloquentCheckpointRepository();
        });

        $this->app->singleton(\VCDM\ModelBuilder\Repository\DomainModelMaterializer::class, function ($app) {
            return new EloquentDomainModelMaterializer();
        });

        $this->app->singleton(\VCDM\ModelBuilder\DomainModificationStream::class, function ($app) {
            return new DomainModificationStream($app->make(\VCDM\ModelBuilder\Repository\EventStoreRepository::class),$app->make(\VCDM\ModelBuilder\Repository\CheckpointRepository::class),$app->make(\VCDM\ModelBuilder\Repository\DomainModelMaterializer::class));
        });


    }


    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/Laravel/config/vcdm.php' => config_path('vcdm.php')], 'vcdm');
        $this->loadMigrationsFrom(__DIR__.'/../../config/Laravel/migrations');
    }

}