<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


/**
 * Class BaseCommand
 * @package App\Console\Commands
 */
class BaseCommand extends Command
{
    /** @var string */
    public $upperCase;

    /** @var string */
    public $lowerCase;

    /** @var string */
    public $name;

    /** Used as placeholder in app.js */
    public $placeholder = "//------- CONTENT -------//";

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

    /**
     * Adds a vue class to the base component directory
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addVue(string $upperCase, string $lowerCase){

        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Adds a vue class to the component/report directory
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportVue(string $upperCase, string $lowerCase){

        $path = resource_path('js/components/reports');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a view controller to Controllers/Views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewController(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Http/Controllers/Views'));

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Views/{$upperCase}ViewController.php"), $controller);
    }

    /**
     * Add a report controller to Controllers/Reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportController(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Http/Controllers/Reports'));

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Reports/{$upperCase}ViewController.php"), $controller);
    }

    /**
     * Add a controller to Controllers
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addController(string $upperCase, string $lowerCase){
        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $upperCase, $controller);
        $controller = str_replace('%model%', $lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/{$upperCase}Controller.php"), $controller);
    }

    //replaced by add model
    public function addClass(string $upperCase, string $lowerCase){}

    /**
     * Add a model to App
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addModel(string $upperCase, string $lowerCase){
        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("{$upperCase}.php"), $class);
    }

    /**
     * Add a model to App/Reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportModel(string $upperCase, string $lowerCase){

        $this->hasDirectory(base_path("App/Reports/"));

        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("/Reports/{$upperCase}Report.php"), $class);
    }

    /**
     * Add a model to App/Views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewModel(string $upperCase, string $lowerCase){

        $this->hasDirectory(app_path('Views'));

        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $upperCase, $class);
        file_put_contents(app_path("Views/{$upperCase}.php"), $class);
    }

    /**
     * Add a vue to base components
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addComponent(string $upperCase, string $lowerCase){
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a report vue to components/reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportComponent(string $upperCase, string $lowerCase){

        $this->hasDirectory(resource_path('js/components/reports/'));

        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/reports/{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a view vue to components/views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewComponent(string $upperCase, string $lowerCase){

        $this->hasDirectory(resource_path('js/components/views/'));

        $path = resource_path('js/components/views/');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "{$upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Register a vue in app.js
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function registerComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }

    /**
     * Register a report vue in app.js
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function registerReportComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/reports/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }

    /**
     * Register a view vue in app.js
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function registerViewComponent(string $upperCase, string $lowerCase){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$lowerCase}-vue', require('./components/views/{$upperCase}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);
    }

    /**
     * Register a blade with a vue component embedded in it.
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addBlade(string $upperCase, string $lowerCase){
        //Create the blade
        $fileName = resource_path("views/") . $lowerCase . '.blade.php';
        $blade = file_get_contents(resource_path('stubs/blade.stub'));

        $blade = str_replace('%model%', $lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    /**
     * Register a report blade with a vue component embedded in it.
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportBlade(string $upperCase, string $lowerCase){

        $this->hasDirectory(resource_path("views/Reports/"));

        //Create the blade
        $fileName = resource_path("views/Reports/") . $lowerCase . '_report.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    /**
     * Register a view blade with a vue component embedded in it.
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
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

    /**
     * Add a request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    /**
     * Add a report request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    /**
     * Add a view request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewRequest(string $upperCase, string $lowerCase){
        Artisan::call("make:request {$upperCase}Request");
    }

    /**
     * Add a route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', '{$upperCase}Controller@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a view route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', '{$upperCase}ViewController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a report route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportRoute(string $upperCase, string $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}', 'Reports/{$upperCase}ReportController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a migration skeleton
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function makeMigration(string $upperCase, string $lowerCase){
        Artisan::call("make:migration make_table_{$lowerCase}s  --table={$lowerCase}s");
    }

    /**
     * Determine if a directory exists. If not, create it.
     *
     * @param $path
     */
    public function hasDirectory($path){

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }

    /**
     * Add single-use routes
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function generateSingleUseRoutes($upperCase, $lowerCase){

        $contents = file_get_contents(base_path('routes/web.php'));

        $contents .= "\r\n";
        $contents .= "Route::get('{$lowerCase}s', '{$upperCase}/{$upperCase}Controller@index');\r\n";
        $contents .= "Route::get('{$lowerCase}s/{ $lowerCase }', '{$upperCase}/{$upperCase}ShowController@show');\r\n";
        $contents .= "Route::post('{$lowerCase}s', '{$upperCase}/{$upperCase}AddController@store');\r\n";
        $contents .= "Route::patch('{$lowerCase}s', '{$upperCase}/{$upperCase}UpdateController@update');\r\n";
        $contents .= "Route::delete('{$lowerCase}s', '{$upperCase}/{$upperCase}DeleteController@delete');\r\n";

        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add single-use controllers
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function generateSingleUseControllers($upperCase, $lowerCase){

        $this->hasDirectory(base_path("App/Http/Controllers/{$upperCase}"));

        $index = file_get_contents(resource_path('stubs/index.stub'));
        $index = str_replace('%MODEL%', $upperCase, $index);
        file_put_contents(app_path("Http/Controllers/{$upperCase}/{$upperCase}Controller.php"), $index);

        $show = file_get_contents(resource_path('stubs/show.stub'));
        $show = str_replace('%MODEL%', $upperCase, $show);
        $show = str_replace('%model%', $lowerCase, $show);
        file_put_contents(app_path("Http/Controllers/{$upperCase}/{$upperCase}ShowController.php"), $show);

        $add = file_get_contents(resource_path('stubs/create.stub'));
        $add = str_replace('%MODEL%', $upperCase, $add);
        file_put_contents(app_path("Http/Controllers/{$upperCase}/{$upperCase}AddController.php"), $add);

        $update = file_get_contents(resource_path('stubs/update.stub'));
        $update = str_replace('%MODEL%', $upperCase, $update);
        file_put_contents(app_path("Http/Controllers/{$upperCase}/{$upperCase}UpdateController.php"), $update);

        $destroy = file_get_contents(resource_path('stubs/destroy.stub'));
        $destroy = str_replace('%MODEL%', $upperCase, $destroy);
        file_put_contents(app_path("Http/Controllers/{$upperCase}/{$upperCase}UpdateController.php"), $destroy);
    }

    /*
    public function setName(string $name){

    }
    public function setUpperCaseName(){}
    public function setLowerCaseName(){}
    */
}

