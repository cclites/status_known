<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ReportFactory extends Command
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

        $lowercaseClassName = strtolower($report);
        $formattedClassName = ucfirst($lowercaseClassName);

        $path = base_path("App/Reports/");

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        //Create Report Handler
        $report = file_get_contents(resource_path('stubs/report.stub'));
        $report = str_replace('%MODEL%', $formattedClassName, $report);
        $report = str_replace('%model%', $lowercaseClassName, $report);
        file_put_contents(app_path("Reports/{$formattedClassName}Report.php"), $report);

        $path = app_path("Http/Controllers/Reports/");

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        //Create Controller
        $controller = file_get_contents(resource_path('stubs/report_controller.stub'));
        $controller = str_replace('%MODEL%', $formattedClassName, $controller);
        $controller = str_replace('%model%', $lowercaseClassName, $controller);
        file_put_contents(app_path("Http/Controllers/Reports/{$formattedClassName}ReportController.php"), $controller);

        //Create Request
        Artisan::call("make:request {$formattedClassName}Request");

        //Add Route
        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowercaseClassName}Report', 'Reports/{$formattedClassName}ReportController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);

        $path = resource_path("views/Reports/");

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        //Create the blade
        $fileName = $path . "/" . $lowercaseClassName . '_report.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $lowercaseClassName, $blade);
        file_put_contents($fileName, $blade);

        /****************************************************************/
        //Create the vue stub
        $path = resource_path('js/components/reports');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$lowercaseClassName}Report.vue";
        file_put_contents($path, $vue);

        //Register the component.
        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowercaseClassName}-report', require('./components/reports/{$lowercaseClassName}Report.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);

        file_put_contents(resource_path('js/app.js'), $appJs);
    }
}
