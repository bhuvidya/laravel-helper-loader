<?php

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
