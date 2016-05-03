# Use the Rackspace adapter

At first you have to install `league/flysystem-rackspace` package via composer:

```sh
$ composer require league/flysystem-rackspace
```

In order to use the Rackspace adapter, you first need to define Rackspace client service.
The Flysystem adapter works with the official [Rackspace package](https://packagist.org/packages/rackspace/php-opencloud).

```neon
services:
    rackspaceCloud:
        class: OpenCloud\Rackspace
        arguments:
            url: "https://identity.api.rackspacecloud.com/v2.0/"
            secret:
                username: rackspaceCloudUsername
                password: rackspaceCloudPassword
```

So now is your Rackspace OpenCloud client defined and will be created by Nette container generator. So lets define Rackspace adapter

```neon
flysystem:
    rackspaceAdapter:
        type: rackspace          # This is adapter type definition
        client: rackspaceCloud   # Dropbox client service name
        prefix: somePrefix       # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/rackspace/).
