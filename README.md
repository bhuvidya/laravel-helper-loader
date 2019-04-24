# Laravel Helper Loader

[![License](https://poser.pugx.org/bhuvidya/laravel-helper-loader/license?format=flat-square)](https://packagist.org/packages/bhuvidya/laravel-helper-loader)
[![Total Downloads](https://poser.pugx.org/bhuvidya/laravel-helper-loader/downloads?format=flat-square)](https://packagist.org/packages/bhuvidya/laravel-helper-loader)
[![Latest Stable Version](https://poser.pugx.org/bhuvidya/laravel-helper-loader/v/stable?format=flat-square)](https://packagist.org/packages/bhuvidya/laravel-helper-loader)
[![Latest Unstable Version](https://poser.pugx.org/bhuvidya/laravel-helper-loader/v/unstable?format=flat-square)](https://packagist.org/packages/bhuvidya/laravel-helper-loader)


Laravel Helper Loader is a package that will load multiple, custom "helper" modules from a given path. 
This allows you to separate your custom helper functions into different php files. You can also
cache multiple helper files into one, quick to load file, a la Laravel "config".

## Installation

Add `bhuvidya/laravel-helper-loader` to your app:

    $ composer require "bhuvidya/laravel-helper-loader"
    

**If you're using Laravel 5.5 or above, you don't have to edit `app/config/app.php`.**

Otherwise, edit `app/config/app.php` and add the service provider:

    'providers' => [
        'BhuVidya\HelperLoader\HelperLoaderServiceProvider',
    ]


## Configuration

The configuration file specifies the path to your helper files (default `APP_ROOT/helpers`), and
the cache file (default `APP_ROOT/bootstrap/cache/helpers.php`).

You can manage and customise the configuration by installing the default config file:

```shell
$ php artisan vendor:publish --provider='BhuVidya\HelperLoader\HelperLoaderServiceProvider' --tag=config
```

The following config file will be published in `config/helper_loader.php`:

```
return [

    /*
    |--------------------------------------------------------------------------
    | Path to helpers. Can either be relative to base path, or use an
    | absolute path.
    |--------------------------------------------------------------------------
    */

    'path' => env('HELPER_LOADER_PATH', 'helpers'),

    /*
    |--------------------------------------------------------------------------
    | Path to cache file. Can either be relative to bootstrap cache path, or use an
    | absolute path.
    |--------------------------------------------------------------------------
    */

    'cache' => env('HELPER_LOADER_CACHE_FILE', 'helpers.php'),

];
```

Alternately, you can set the Helper Loader config vars by using your `.env` file. As you can
see above, the env variables used are:

```
HELPER_LOADER_PATH
HELPER_LOADER_CACHE_FILE
```

## Usage

So once your helpers path is set, you can freely add and edit helper modules to that path, and they
will be loaded automatically for you. For a production environment, you may want to cache your helper
files. You can do this in a way similar to caching your config files:

```
$ php artisan helper-loader:cache
```

If the helper loader cache file exists, it is always loaded, even if you have updated or added to
your helper modules. You can clear the cache file as follows:

```
$ php artisan helper-loader:clear
```


## License

MIT

