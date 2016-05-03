# Use the WebDav adapter

At first you have to install `league/flysystem-webdav` package via composer:

```sh
$ composer require league/flysystem-webdav
```

In order to use the WebDav adapter, you first need to define WebDav client service.
The Flysystem adapter works with the official [Sabre/Dav package](https://packagist.org/packages/sabre/dav).

```neon
services:
    webdav:
        class: Sabre\DAV\Client
        arguments:
            settings:
                baseUri: base uri address
                userName: someUsername          # Optional
                password: usernamePassword      # Optional
                proxy: proxySettings            # Optional
                authType: ~                     # Optional
                encoding: ~                     # Optional
```

NOTE: For more information about configuration, visit package [manual](http://sabre.io/dav/davclient/)

So now is your WebDav client defined and will be created by Nette container generator. So lets define WebDav adapter

```neon
flysystem:
    webDavAdapter:
        type: webdav        # This is adapter type definition
        client: webdav      # WebDav client service name
        prefix: somePrefix  # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/webdav/).
