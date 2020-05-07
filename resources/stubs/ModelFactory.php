<?php

namespace App\Console\Commands;

/**
 * NOTES: This factory is used to create a model representing a business object (such as a report or invoice).
 *        It also creates 2 request objects (such as a ReportRequest and ReportUpdateRequest), generates single
 *        use controllers, and all routes for the controllers.
 *
 *        There is no associated view.
 */

/**
 * Class ModelFactory
 * @package App\Console\Commands
 */
class ModelFactory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:model {model}  {directory=""}';

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
        $this->setup($this->argument('vue'), $this->argument('directory'));

        $this->addClass();

        $this->addRequest();

        $addUpdateRequest = true;
        $this->addRequest($addUpdateRequest);

        $this->generateSingleUseControllers();

        $this->generateSingleUseRoutes();

        $this->makeMigration();

    }


}
