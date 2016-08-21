<?php

namespace Kanboard\ServiceProvider;

use Kanboard\Core\Cache\FileCache;
use Kanboard\Core\Cache\MemoryCache;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Cache Provider
 *
 * @package Kanboard\ServiceProvider
 * @author  Frederic Guillot
 */
class CacheProvider implements ServiceProviderInterface
{
    /**
     * Register providers
     *
     * @access public
     * @param  \Pimple\Container $container
     * @return \Pimple\Container
     */
    public function register(Container $container)
    {
        $container['memoryCache'] = function() {
            return new MemoryCache();
        };

        if (CACHE_DRIVER === 'file') {
            $container['cacheDriver'] = function() {
                return new FileCache();
            };
        } else {
            $container['cacheDriver'] = $container['memoryCache'];
        }

        return $container;
    }
}
