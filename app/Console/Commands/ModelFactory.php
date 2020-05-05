<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModelFactory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:model {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate framework for a model with single-responsibility controllers, requests, and routes. Includes migration';

    public $model;

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

        $this->itemName($this->argument('model'));

        Artisan::call("make:model $this->upperCase");

        Artisan::call("make:request {$this->upperCase}Request");
        Artisan::call("make:request {$this->upperCase}UpdateRequest");

        $this->generateSingleUseControllers($this->upperCase, $this->lowerCase);

        $this->generateSingleUseRoutes($this->upperCase, $this->lowerCase);

        $this->makeMigration($this->upperCase, $this->lowerCase);

    }


}
