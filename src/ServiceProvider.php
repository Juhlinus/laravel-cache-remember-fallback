<?php

namespace Juhlinus\CacheFallback;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        // We replace the cache manager by our implementation
        $this->app->extend('cache', function () {
            return new CacheManagerProxy($this->app);
        });

        $this->app->extend('cache.store', function () {
            return $this->app['cache']->driver();
        });
    }
}