<?php

namespace OSSTools\IBMCloudObjectStorage\Laravel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use OSSTools\Flysystem\IBMCloudObjectStorage\IbmCosAdapter;
use Illuminate\Filesystem\FilesystemAdapter;

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
        Storage::extend('ibm-cos', function ($app, $config) {
            $adapter = new IbmCosAdapter($config, $config['bucket']);

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
