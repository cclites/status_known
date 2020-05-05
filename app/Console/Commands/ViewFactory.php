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
        $this->itemName($this->argument('vue'));

        //Create vue component
        $this->addViewComponent();

        //create route
        $this->addViewRoute();

        //register component
        $this->registerViewComponent();

        //add view controller
        $this->addViewController();

        //Make a model
        $this->addViewModel();

        $this->addViewBlade();



    }
}
