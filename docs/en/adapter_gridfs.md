# Use the GridFS adapter

At first you have to install `league/flysystem-gridfs` package via composer:

```sh
$ composer require league/flysystem-gridfs
```

In order to use the GridFS adapter, you first need to define GridFS client service.
This Flysystem adapter works with the MongoDB PHP extension.

```neon
services:
    gridFS.Mongo: 
        class: Mongo
        arguments:
            server: mongodb://localhost:27017
            options:
                connect: TRUE
    gridFS.MongoDB:
        class: MongoDB
        arguments:
            conn: @gridFS.Mongo
            name: mongoDBname
    gridFS.Client:
        class: MongoGridFS
        arguments:
            db: @gridFS.MongoDB
            prefix: fs
```

So now is your GridFS client defined and will be created by Nette container generator. So lets define Dropbox adapter

```neon
flysystem:
    dropboxAdapter:
        type: gridfs            # This is adapter type definition
        client: gridFS.Client   # Dropbox client service name
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/gridfs/).
