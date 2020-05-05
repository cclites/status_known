<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ReportFactory extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:report {report}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate boilerplate for a report';

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
        $this->itemName($this->argument('report'));

        $this->addReportModel();

        $this->addReportController();

        $this->addReportRequest();

        $this->addReportRoute();

        $this->addReportBlade();

        $this->addReportVue();

        $this->registerReportComponent();

        /****************************************************************/
    }
}
