<?php

namespace BhuVidya\HelperLoader\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use BhuVidya\HelperLoader\HelperLoaderFacade;

class HelperLoaderClearCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'helper-loader:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Helper Loader - Clear all cached helpers.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        HelperLoaderFacade::clearCache();

        $this->info('Helpers now cleared!');
    }
}
