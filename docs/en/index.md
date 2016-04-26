# Quickstart

If you need to handle file storing and reading on various file systems, checkout [Flysystem](http://flysystem.thephpleague.com/) from [The PHP League](http://thephpleague.com/).
This extension is implementing Flysystem into your application based on [Nette Framework](http://nette.org/)

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
