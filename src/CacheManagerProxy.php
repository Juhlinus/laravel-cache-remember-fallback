<?php

namespace Juhlinus\CacheFallback;

use Closure;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Events\Dispatchert;

class CacheManagerProxy extends CacheManager
{
    /**
     * Create a new cache repository with the given implementation using our {@see RepositoryProxy}.
     *
     * @param Store $store The Laravel cache store instance.
     *
     * @return RepositoryProxy The repository proxy.
     */
    public function repository(Store $store): RepositoryProxy
    {
        $repository = new RepositoryProxy($store, $this);

        if ($this->app->bound(Dispatcher::class)) {
            $repository->setEventDispatcher($this->app[Dispatcher::class]);
        }

        return $repository;
    }
}