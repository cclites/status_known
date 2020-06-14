<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class Factory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'factory:build {file} {directory?}';
    protected $signature = 'factory:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used for random tests';

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

        $business_id = 1;

        $recordCount = 4;
        $records = factory(\App\Record::class, 4)
                        ->create(['business_id'=> $business_id])
                        ->each(function($record) use ($business_id){

                            factory(\App\Invoice::class)
                                ->create(
                                    [
                                        'business_id'=> $business_id,
                                    ]
                                );
                        });


        //$this->setup($this->argument('file'), $this->argument('directory'));

        //$this->addVueComponent();
        //$this->registerComponent();
        //$this->addController();
        //$this->addRequest();
        //$this->addClass();


        /*
        $this->addVueComponent();
        $this->registerComponent(true);
        $this->addRoute();
        $this->addController();
        $this->createTableMigration();
        $this->addBlade();
        $this->addClass();
        $this->addRequest();
        $this->generateRoutes();
        $this->generateSingleResponsibilityRoutes();
        $this->generateSingleResponsibilityControllers();
        $this->toString();
        */
    }
}
