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
        $report = $this->argument('report');

        $lowerCase = strtolower($report);
        $upperCase = ucfirst($lowerCase);

        /***********************************/

        $this->addReportModel($upperCase, $lowerCase);

        $this->addReportController($upperCase, $lowerCase);

        $this->addRequest($upperCase, $lowerCase);

        $this->addRoute($upperCase, $lowerCase);

        $this->addResource($upperCase, $lowerCase);

        $this->addPrintBlade($upperCase, $lowerCase);

        $this->addReportView($upperCase, $lowerCase);

        $this->registerPrintComponents($upperCase, $lowerCase);

        /****************************************************************/
    }
}