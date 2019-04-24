<?php

namespace BhuVidya\HelperLoader;

use Illuminate\Support\Facades\Facade;

class HelperLoaderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'helper-loader';
    }
}
