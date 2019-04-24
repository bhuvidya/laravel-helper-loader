<?php

namespace BhuVidya\HelperLoader\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use BhuVidya\HelperLoader\HelperLoaderFacade;

class HelperLoaderCacheCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'helper-loader:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Helper Loader - Cache all helpers.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        HelperLoaderFacade::cacheAllHelpers();

        $this->info('Helpers now cached!');
    }
}
