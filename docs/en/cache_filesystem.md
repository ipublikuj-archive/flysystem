# Cache your filesystems

The [Flysystem](http://flysystem.thephpleague.com/) library provides a few caching strategies for you to use in your adapters. This reduces the amount of API calls across requests and therefore improves job execution times and/or page loads.

In order to use a cache in your adapter you have to install the cached adapter with composer (see also http://flysystem.thephpleague.com/caching/)

```bash
composer require league/flysystem-cached-adapter
```
