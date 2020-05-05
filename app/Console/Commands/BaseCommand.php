<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


/**
 * Class BaseCommand
 * @package App\Console\Commands
 */
class BaseCommand extends Command
{
    /** @var string */
    public $itemName;

    /** @var string */
    public $upperCase;

    /** @var string */
    public $lowerCase;

    /** @var string */
    public $kebabCase;

    /** @var string */
    public $snakeCase;

    /** @var string */
    //public $name;

    protected $signature = 'base-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Demo Admin';


    /** Used as placeholder in app.js */
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
     * Adds a vue class to the base component directory
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addVue(){

        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$this->upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Adds a vue class to the component/report directory
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportVue(){

        $this->hasDirectory(resource_path('js/components/reports'));

        $path = resource_path('js/components/reports');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$this->upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a view controller to Controllers/Views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewController(){

        $this->hasDirectory(app_path('Http/Controllers/Views'));

        $controller = file_get_contents(resource_path('stubs/view_controller.stub'));
        $controller = str_replace('%MODEL%', $this->upperCase, $controller);
        $controller = str_replace('%model%', $this->lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Views/{$this->itemName}ViewController.php"), $controller);
    }

    /**
     * Add a report controller to Controllers/Reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportController(){

        $this->hasDirectory(app_path('Http/Controllers/Reports'));

        $controller = file_get_contents(resource_path('stubs/report_controller.stub'));
        $controller = str_replace('%MODEL%', $this->upperCase, $controller);
        $controller = str_replace('%model%', $this->lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/Reports/{$this->itemName}ReportController.php"), $controller);
    }

    /**
     * Add a controller to Controllers
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addController(){
        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $this->itemName, $controller);
        $controller = str_replace('%model%', $this->lowerCase, $controller);
        file_put_contents(app_path("Http/Controllers/{$this->itemName}Controller.php"), $controller);
    }

    //replaced by add model
    public function addClass(){}

    /**
     * Add a model to App
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addModel(){
        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $this->itemName, $class);
        file_put_contents(app_path("{$this->itemName}.php"), $class);
    }

    /**
     * Add a model to App/Reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportModel(){

        $this->hasDirectory(base_path("App/Reports/"));

        $class = file_get_contents(resource_path('stubs/report_class.stub'));
        $class = str_replace('%MODEL%', $this->itemName, $class);
        file_put_contents(app_path("/Reports/{$this->itemName}Report.php"), $class);
    }

    /**
     * Add a model to App/Views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewModel(){

        $this->hasDirectory(app_path('Views'));

        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $this->itemName, $class);
        file_put_contents(app_path("Views/{$this->itemName}.php"), $class);
    }

    /**
     * Add a vue to base components
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addComponent(){
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$this->itemName}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a report vue to components/reports
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportComponent(){

        $this->hasDirectory(resource_path('js/components/reports/'));

        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/reports/{$this->itemName}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Add a view vue to components/views
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewComponent(){

        $this->hasDirectory(resource_path('js/components/views/'));

        $path = resource_path('js/components/views/');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "{$this->upperCase}.vue";
        file_put_contents($path, $vue);
    }

    /**
     * Register a vue in app.js
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function registerComponent(){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$this->kebabCase}', require('./components/{$this->lowerCase}.vue').default);\r\n";
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
    public function registerReportComponent(){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$this->kebabCase}-report', require('./components/reports/{$this->upperCase}.vue').default);\r\n";
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
    public function registerViewComponent(){

        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$this->kebabCase}-vue', require('./components/views/{$this->upperCase}.vue').default);\r\n";
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
    public function addBlade(){
        //Create the blade
        $fileName = resource_path("views/") . $this->lowerCase . '.blade.php';
        $blade = file_get_contents(resource_path('stubs/blade.stub'));

        $blade = str_replace('%model%', $this->lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    /**
     * Register a report blade with a vue component embedded in it.
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportBlade(){

        $this->hasDirectory(resource_path("views/reports/"));

        //Create the blade
        $fileName = resource_path("views/reports/") . $this->lowerCase . '_report.blade.php';
        $blade = file_get_contents(resource_path('stubs/report_blade.stub'));

        $blade = str_replace('%model%', $this->lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    /**
     * Register a view blade with a vue component embedded in it.
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewBlade(){

        $this->hasDirectory(resource_path("views/views/"));

        //Create the blade
        $fileName = resource_path("views/views/") . $this->lowerCase . '_view.blade.php';
        $blade = file_get_contents(resource_path('stubs/view_blade.stub'));

        $blade = str_replace('%model%', $this->lowerCase, $blade);
        file_put_contents($fileName, $blade);
    }

    public function addReportHandler(){

    }

    /**
     * Add a request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addRequest(){
        Artisan::call("make:request {$this->upperCase}Request");
    }

    /**
     * Add a report request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportRequest(){
        Artisan::call("make:request {$this->upperCase}ReportRequest");
    }

    /**
     * Add a view request
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewRequest(){
        Artisan::call("make:request {$this->upperCase}ViewRequest");
    }

    /**
     * Add a route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addRoute(){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$this->kebabCase}', '{$this->upperCase}Controller@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a view route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addViewRoute(){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$this->kebabCase}', 'Views\{$this->upperCase}ViewController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a report route
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function addReportRoute(){

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$this->kebabCase}-report', 'Reports\{$this->upperCase}ReportController@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add a migration skeleton
     *
     * @param string $upperCase
     * @param string $lowerCase
     */
    public function makeMigration(){
        Artisan::call("make:migration make_table_{$this->lowerCase}s  --table={$this->lowerCase}s");
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
    public function generateSingleUseRoutes(){

        $contents = file_get_contents(base_path('routes/web.php'));

        $contents .= "\r\n";
        $contents .= "Route::get('{$this->lowerCase}s', '{$this->upperCase}/{$this->upperCase}Controller@index');\r\n";
        $contents .= "Route::get('{$this->lowerCase}s/{ $this->lowerCase }', '{$this->upperCase}/{$this->upperCase}ShowController@show');\r\n";
        $contents .= "Route::post('{$this->lowerCase}s', '{$this->upperCase}/{$this->upperCase}AddController@store');\r\n";
        $contents .= "Route::patch('{$this->lowerCase}s', '{$this->upperCase}/{$this->upperCase}UpdateController@update');\r\n";
        $contents .= "Route::delete('{$this->lowerCase}s', '{$this->upperCase}/{$this->upperCase}DeleteController@delete');\r\n";

        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /**
     * Add single-use controllers

     */
    public function generateSingleUseControllers(){

        $this->hasDirectory(base_path("App/Http/Controllers/{$this->upperCase}"));

        $index = file_get_contents(resource_path('stubs/index.stub'));
        $index = str_replace('%MODEL%', $this->upperCase, $index);
        file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}Controller.php"), $index);

        $show = file_get_contents(resource_path('stubs/show.stub'));
        $show = str_replace('%MODEL%', $this->upperCase, $show);
        $show = str_replace('%model%', $this->lowerCase, $show);
        file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}ShowController.php"), $show);

        $add = file_get_contents(resource_path('stubs/create.stub'));
        $add = str_replace('%MODEL%', $this->upperCase, $add);
        file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}AddController.php"), $add);

        $update = file_get_contents(resource_path('stubs/update.stub'));
        $update = str_replace('%MODEL%', $this->upperCase, $update);
        file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}UpdateController.php"), $update);

        $destroy = file_get_contents(resource_path('stubs/destroy.stub'));
        $destroy = str_replace('%MODEL%', $this->upperCase, $destroy);
        file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}UpdateController.php"), $destroy);
    }

    public function itemName($itemName){

        $this->itemName = $itemName;
        $this->lowerCase = strtolower($this->itemName);
        $this->upperCase = ucfirst($this->itemName);
        $this->kebabCase = Str::kebab($this->itemName);
        $this->snakeCase = Str::snake($this->itemName);
    }

    public function camelCaseToKebabCase($itemName){
        return Str::kebab($itemName);
    }

    public function camelCaseToSnakeCase($itemName){
        return Str::snake($itemName);
    }
}

