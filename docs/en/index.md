# Quickstart

If you need to handle file storing and reading on various file systems, checkout [Flysystem](http://flysystem.thephpleague.com/) from [The PHP League](http://thephpleague.com/).
This extension is implementing [Flysystem](http://flysystem.thephpleague.com/) into your application based on [Nette Framework](http://nette.org/)

## Installation

The best way to install ipub/flysystem is using [Composer](http://getcomposer.org/):

```sh
$ composer require ipub/flysystem
```

After that you have to register extension in config.neon.

```neon
extensions:
	flysystem: IPub\Flysystem\DI\FlysystemExtension
```

## Creating adapters

As a first step is to define your file adapters. Adapters are used for manipulation with files.

```neon
flysystem:
    adapters:
        my_local_adapter:
            type: local
            directory: %baseDir%/cache

        other_adapter:
            type: local
            directory: %baseDir%/other
```

### There are a bunch of adapters for you to use:

* [AwsS3](adapter_awss3.md)
* [Dropbox](adapter_dropbox.md)
* [Ftp] (adapter_ftp.md)
* [Local filesystem](adapter_local.md)
* [Null/Test](adapter_null.md)
* [Rackspace](adapter_rackspace.md)
* [SFtp](adapter_sftp.md)
* [WebDav](adapter_webdav.md)   
* [ZipArchive](adapter_ziparchive.md)
* [GridFS](adapter_gridfs.md)

## Create and use your filesystems

Next step for using Flysystem is to create filesystem service, that will handle all your read, write, etc. commands, but at first you have to define adapter.

```neon
flysystem:
    adapters:
        my_local_adapter:
            type: local
            directory: %baseDir%/cache

        other_adapter:
            type: local
            directory: %baseDir%/other

    filesystems:
        my_filesystem:
            adapter: my_local_adapter
```

This definition will create new service for you to use:

```php
$filesystem = $container->getService('flysystem.filesystem.my_filesystem');
```

The naming scheme follows a simple rule: `flysystem.filesystem.%s` whereas %s is the name of your filesystem.

The `$filesystem` variable is of the type [`\League\Flysystem\Filesystem`](https://github.com/thephpleague/flysystem/blob/master/src/Filesystem.php).
Please refer to the [*General Usage* section](http://flysystem.thephpleague.com/api/#general-usage) in the official documentation for details.

## Using mount manager

All filesystems are automatically mounted to the mount manager service for easy usage. Now, when your filesystem is created, you can just inject mount manager where you need to operate with files:

```php
class FileUploadPresenter extends BasePresenter
{
    /**
     * @var League\Flysystem\MountManager
     */
    private $mountManager;

    /**
     * @param League\Flysystem\MountManager $mountManager
     */
    public function __construct(League\Flysystem\MountManager $mountManager)
    {
        $this->mountManager = $mountManager;
    }
    
    public function handleUpload()
    {
        //...do some stuff
        
        $this->mountManager->write('my_filesystem://path/where/to/save/filename.ext', $fileContent);
    }
}
```

Details on the usage of the MountManager can be found in the [Flysystem documentation](http://flysystem.thephpleague.com/mount-manager/).

## What next?

* [Cache your filesystems](cache_filesystem.md)
