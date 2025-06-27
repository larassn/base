<?php

namespace Modules\Base\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();

    }

    public function boot()
    {
        //
    }

    private function registerConfig(): void
    {
        foreach (File::glob(__DIR__ . '/../../config/*.php') as $file) {
            if (basename($file) == 'graphql.php') {
                continue;
            }

            $this->publishes([
                $file => config_path(basename($file)),
            ], 'config');

            $this->mergeConfigFrom(
                $file, basename($file, '.php')
            );
        }
    }
}
