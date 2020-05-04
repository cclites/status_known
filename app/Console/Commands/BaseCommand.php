<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
    }

    public function addVue(string $upperCase, string $lowerCase){

        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    public function addReportVue(string $upperCase, string $lowerCase){

        $path = resource_path('js/components/reports');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    public function addViewController(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Http/Controllers/Views'));

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Views/{$upperCase}ViewController.php"), $controller);
    }

    public function addReportController(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Http/Controllers/Reports'));

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Reports/{$upperCase}ViewController.php"), $controller);
    }

    public function addController(string $upperCase, string $lowerCase){
        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/{$upperCase}Controller.php"), $controller);
    }

    public function addClass(string $upperCase, string $lowerCase){}

    public function addModel(string $upperCase, string $lowerCase){
        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("{$upperCase}.php"), $class);
    }

    public function addReportModel(string $upperCase, string $lowerCase){

        $this->hasDirectory(base_path("App/Reports/"));

        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("/Reports/{$upperCase}Report.php"), $class);
    }

    public function addViewModel(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Views'));

        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("Views/{$upperCase}.php"), $class);
    }

    public function addComponent(string $upperCase, string $lowerCase){
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    public function addReportComponent(string $upperCase, string $lowerCase){
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/reports/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    public function addViewComponent(string $upperCase, string $lowerCase){
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/views/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    public function registerComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }

    public function registerReportComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/reports/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }

    public function registerViewComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/views/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }


    public function addBlade(string $upperCase, string $lowerCase){
        //Create the blade
        $fileName = resource_path("views/") . $lowerCase . '.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    public function addReportBlade(string $upperCase, string $lowerCase){

        $this->hasDirectory(resource_path("views/Reports/"));

        //Create the blade
        $fileName = resource_path("views/Reports/") . $lowerCase . '_report.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    public function addViewBlade(string $upperCase, string $lowerCase){

        $this->hasDirectory(resource_path("views/Views/"));

        //Create the blade
        $fileName = resource_path("views/Views/") . $lowerCase . '_view.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    public function addReportHandler(string $upperCase, string $lowerCase){

    }


    public function addRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    public function addReportRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    public function addViewRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    public function addRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', '{$upperCase}Controller@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    public function addViewRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', '{$upperCase}ViewController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    public function addReportRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', 'Reports/{$upperCase}ViewController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    public function hasDirectory($path){

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }
}

