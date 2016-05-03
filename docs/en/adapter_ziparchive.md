# Use the Zip archive adapter

At first you have to install `league/flysystem-ziparchive` package via composer:

```sh
$ composer require league/flysystem-ziparchive
```

Now you can define your Zip archive adapter:

```neon
flysystem:
    dropboxAdapter:
        type: zip                       # This is adapter type definition
        location: path/to/archive.zip   # Full path to zip file archive
        archive: ZipArchiveObject       # Optional zip archive object
        prefix: somePrefix              # Optional prefix
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/zip-archive/).
