<?php

namespace BhuVidya\HelperLoader;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Filesystem\Filesystem;

class HelperLoader
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;


    /**
     * Ctor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(ApplicationContract $app, Filesystem $files)
    {
        $this->app = $app;
        $this->files = $files;
    }

    /**
     * Load the helpers.
     *
     * @return bool
     */
    public function load()
    {
        $cache = $this->getHelpersCacheFile();

        if (file_exists($cache)) {
            require_once($cache);
        }

        $this->loadHelpersDynamically();

        return true;
    }

    /**
     * Load all the helpers dynamically from disk.
     *
     * @return bool
     */
    public function loadHelpersDynamically()
    {
        $path = $this->getHelpersPath();

        foreach (glob("{$path}/*.php") as $file) {
            require_once($file);
        }
    }

    /**
     * Cache all the helpers into one file.
     *
     * @return bool
     */
    public function cacheAllHelpers()
    {
        $path = $this->getHelpersPath();
        $code = '';

        foreach (glob("{$path}/*.php") as $file) {
            $trim = trim(@file_get_contents($file) ?? '');
            $code .= rtrim(ltrim($trim, '<?php'), '?>');
        }

        $this->files->put($this->getHelpersCacheFile(), '<?php ' . $code);

        return true;
    }

    /**
     * Clear the cache.
     *
     * @return bool
     */
    public function clearCache()
    {
        if (!@unlink($this->getHelpersCacheFile())) {
            return false;
        }

        return true;
    }

    /**
     * Get the path to the helper php files.
     */
    public function getHelpersPath()
    {
        $path = config('helper_loader.path');
        if ($path[0] !== DIRECTORY_SEPARATOR) {
            $path = base_path($path);
        }

        return $path;
    }

    /**
     * Get the path to the cache file.
     */
    public function getHelpersCacheFile()
    {
        $path = config('helper_loader.cache');
        if ($path[0] !== DIRECTORY_SEPARATOR) {
            $path = $this->app->bootstrapPath("cache/{$path}");
        }

        return $path;
    }
}
