# Use the Dropbox adapter

At first you have to install `league/flysystem-dropbox` package via composer:

```sh
$ composer require league/flysystem-dropbox
```

In order to use the Dropbox adapter, you first need to define Dropbox client service.
The Flysystem adapter works with the official [Dropbox SDK](https://www.dropbox.com/developers/core/sdks/php).

```neon
services:
    dropbox:
        class: Dropbox\Client
        arguments:
            accessToken: yourAccessToken
            clientIdentifier: dropboxIdentifier
```

So now is your Dropbox client defined and will be created by Nette container generator. So lets define Dropbox adapter

```neon
flysystem:
    dropboxAdapter:
        type: dropbox       # This is adapter type definition
        client: dropbox     # Dropbox client service name
        prefix: somePrefix  # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/dropbox/).
