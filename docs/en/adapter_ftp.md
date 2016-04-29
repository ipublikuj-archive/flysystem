# Use the FTP adapter

This adapter come with default Flysystem package.
This adapter works with the standard PHP FTP implementation which is documented in [the manual](http://www.php.net/manual/en/book.ftp.php)

```neon
flysystem:
    ftpAdapter:
        type: ftp                   # This is adapter type definition
        host: ftp.yourdomain.com    # FTP host name
        username: someName          # Optional username for connection to host
        password: userPassword      # Optional password for connection to host
        port: 21                    # Optional port number. Can be omitted and default value will be used
        root: path/to/root          # Optional path where should be root for this adapter
        passive: true/false         # Optional enable or disable passive mode. Default is true
        ssl: true/false             # Optional enable or disable ssl connection. Default is true
        timeout: 30                 # Optional connection timeout. Default is 30
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/ftp/).
