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
    protected $description = 'Create a vue module and boiler plate';

    public $placeholder = "//------- CONTENT -------//";

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
        $this->addComponent($upperCase, $lowerCase);

        //create route
        $this->addRoute($upperCase, $lowerCase);

        //register component
        $this->registerComponent($upperCase, $lowerCase);

        //create view controller
        $this->registerComponent($upperCase, $lowerCase);

        //add view controller
        $this->addViewController($upperCase, $lowerCase);

        //Make a model
        $this->addModel($upperCase, $lowerCase);



    }
}
