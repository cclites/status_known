<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
     * @return mixed
     */
    public function handle()
    {
        $mathematicians = array('archimedes','euler', 'pythagoras');
        array_push($mathematicians, 'hypatia');
        array_push($mathematicians, 'fibonacci');
        array_pop($mathematicians);
        echo array_pop($mathematicians);
        echo sizeof($mathematicians);

    }
}
