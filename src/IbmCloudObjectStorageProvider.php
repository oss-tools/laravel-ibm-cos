<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Tavux\Flysystem\IBMCloudObjectStorage\IbmCosAdapter;

class IbmCloudObjectStorageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/filesystems.php',
            'filesystems.disks'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('ibm-cos', function($app, $config) {
            return new Filesystem(new IbmCosAdapter($config, $config['bucket']));
        });
    }
}
