<?php

namespace Bmatovu\ArtisanGui\Tests;

use Illuminate\Console\Command;

/**
 * @see https://laravel.com/docs/master/artisan Documentation
 */
class DummyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dummy {arg} {array-args} {--bool-opt} {--value-opt=} {--array-opts=*}';

    // protected $signature = 'command:dummy
    //                             {required-arg} {optional-arg?} {default-arg=foo} {array-args*}
    //                             {--bool-option} {--value-option=} {--default-option=bar} {--array-options=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('arg') == 'exception') {
            throw new \Exception('We ran into an exception!');
        }

        $this->info('Dummy command ran successful.');

        return 0;
    }
}
