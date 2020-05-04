<?php

namespace App\Console\Commands;

class ViewFactory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:vue {vue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a vue module and boiler plate. Does not include a migration';

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
        $vue = $this->argument('vue');

        $lowerCase = strtolower($vue);
        $upperCase = ucfirst($lowerCase);

        //Create vue component
        $this->addViewComponent($upperCase, $lowerCase);

        //create route
        $this->addViewRoute($upperCase, $lowerCase);

        //register component
        $this->registerViewComponent($upperCase, $lowerCase);

        //add view controller
        $this->addViewController($upperCase, $lowerCase);

        //Make a model
        $this->addViewModel($upperCase, $lowerCase);

        $this->addBlade($upperCase, $lowerCase);



    }
}
