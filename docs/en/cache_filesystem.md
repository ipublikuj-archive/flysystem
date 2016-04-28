# Cache your filesystems

The [Flysystem](http://flysystem.thephpleague.com/) library provides a few caching strategies for you to use in your adapters. This reduces the amount of API calls across requests and therefore improves job execution times and/or page loads.

In order to use a cache in your adapter you have to install the cached adapter with composer (see also http://flysystem.thephpleague.com/caching/)

```bash
composer require league/flysystem-cached-adapter
```

Cache configuration is similar to adapter configuration.

```neon
flysystem:
    adapters:
        my_local_adapter:
            type: local
            directory: %baseDir%/cache

    cache
        memory_cache:
            type: memory

    filesystems:
        my_cached_filesystem:
            adapter: my_local_adapter
            cache: memory_cache
```

## Memory

```neon
flysystem:
    cache:
        my_cache:
            type: memory
```

## Memcached

```neon
services:
    cache.memcached:
        class: Memcached
        setup:
            - addServer("memcached.domain.com", 11211)

flysystem:
    cache:
        my_cache:
            type: memcached
            client: cache.memcached
            key: someStringKey  # defaults to "ipub.flysystem"
            expires: 123        # defaults to "300"
```

## Redis (through Predis)

The Redis cache implementation works with the Predis library. You can find more in-depth configuration options in the [corresponding documentation](https://github.com/nrk/predis#client-configuration).

```neon
services:
    cache.redis:
        class: Predis\Client

flysystem:
    cache:
        my_cache:
            type: predis
            client: cache.redis
            key: someStringKey  # defaults to "ipub.flysystem"
            expires: 123        # defaults to "300"
```

## [Stash](https://github.com/tedious/Stash)

> Stash makes it easy to speed up your code by caching the results of expensive functions or code. Certain actions, like database queries or calls to external APIs, take a lot of time to run but tend to have the same results over short periods of time. This makes it much more efficient to store the results and call them back up later.

To learn more about available drivers, check out http://www.stashphp.com/.

```neon
services:
    cache.stash:
        class: Stash\Pool

flysystem:
    cache:
        my_cache:
            type: stash
            pool: cache.stash
            key: someStringKey  # defaults to "ipub.flysystem"
            expires: 123        # defaults to "300"
```

## Noop

This strategy prevents any kind of caching, even in the current request. Use with caution!

```neon
flysystem:
    cache:
        my_cache:
            type: noop
```
