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
    protected $description = 'Generate boilerplate for a class. Creates a migration. No vue components';

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
        $this->itemName($this->argument('class'));

        $this->addModel();

        $this->addController();

        $this->addVue();

        $this->addRoute();

        $this->registerComponent();

        $this->makeMigration();


    }
}
