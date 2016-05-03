# Use the SFTP adapter

At first you have to install `league/flysystem-sftp` package via composer:

```sh
$ composer require league/flysystem-sftp
```

Now you can configure your SFTP adapter:

```neon
flysystem:
    ftpAdapter:
        type: sftp                  # This is adapter type definition
        host: ftp.yourdomain.com    # FTP host name
        username: someName          # Optional username for connection to host
        password: userPassword      # Optional password for connection to host
        port: 21                    # Optional port number. Can be omitted and default value will be used
        root: path/to/root          # Optional path where should be root for this adapter
        timeout: 30                 # Optional connection timeout. Default is 30
        privateKey: path/to/key     # Optional your private key path
        permPublic: 0000            # Optional
        permPrivate: 0744           # Optional
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/sftp/).
