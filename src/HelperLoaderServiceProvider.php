<?php

namespace BhuVidya\HelperLoader;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use BhuVidya\HelperLoader\HelperLoader;
use BhuVidya\HelperLoader\HelperLoaderFacade;
use BhuVidya\HelperLoader\Console\Commands\HelperLoaderCacheCommand;
use BhuVidya\HelperLoader\Console\Commands\HelperLoaderClearCommand;

class HelperLoaderServiceProvider extends BaseServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('helper-loader', function () {
            return new HelperLoader($this->app, $this->app->files);
        });

        AliasLoader::getInstance()->alias('HelperLoader', HelperLoaderFacade::class);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/helper_loader.php');
        $this->mergeConfigFrom($source, 'helper_loader');

        // config file
        if ($this->app->runningInConsole()) {
            $source = realpath(__DIR__ . '/../config/helper_loader.php');
            $this->publishes([ $source => config_path('helper_loader.php') ], 'config');
        }

        // load the helpers
        $this->app->make('helper-loader')->load();

        // comands
        $this->commands([
            HelperLoaderCacheCommand::class,
            HelperLoaderClearCommand::class,
        ]);
    }
}
