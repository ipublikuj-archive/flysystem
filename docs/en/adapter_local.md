# Use the local adapter

This adapter come with default Flysystem package. This adapter store files in the same filesystem your application is installed.

```neon
flysystem:
    localAdapter:
        type: local                             # This is adapter type definition
        directory: path/where/to/save           # Full path where to save your files
        writeFlags: filesystemFlag              # Optional PHP werite flag definition, se more in the [manual](http://php.net/manual/en/filesystem.constants.php)
        linkHandling: skipLinks|disallowLinks   # Optional link handling definition. Default is disallowLinks
```

For more info about this adapter, please take a look at the [Flysystem documentation](http://flysystem.thephpleague.com/adapter/local/).

