<?php

namespace App\Console\Commands;

class ClassFactory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:class {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate boilerplate for a class';

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
     * TODO: This should not all be in one function
     *
     * @return mixed
     */
    public function handle()
    {
        $class = $this->argument('class');

        $lowerCase = strtolower($class);
        $upperCase = ucfirst($lowerCase);

        //Make a model
        $this->addModel($upperCase, $lowerCase);

        //make a controller
        $this->addController($upperCase, $lowerCase);

        //make a vue
        $this->addVue($upperCase, $lowerCase);

        //Add Route
        $this->addRoute($upperCase, $lowerCase);

        //register component
        $this->registerComponent($upperCase, $lowerCase);

    }
}
