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
        /** @var  $class represents the name of a class*/
        $class = $this->argument('class');

        $lowerCase = strtolower($class);
        $upperCase = ucfirst($lowerCase);
        
        $this->addModel($upperCase, $lowerCase);

        $this->addController($upperCase, $lowerCase);

        $this->addVue($upperCase, $lowerCase);

        $this->addRoute($upperCase, $lowerCase);

        $this->registerComponent($upperCase, $lowerCase);

        $this->makeMigration($upperCase, $lowerCase);


    }
}
