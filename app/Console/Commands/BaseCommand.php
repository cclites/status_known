<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Class BaseCommand
 * @package App\Console\Commands
 */
class BaseCommand extends Command
{
    /** @var string */
    public $fileName;

    /** @var string */
    public $file;

    /** @var string */
    public $classPath;

    /** @var string */
    public $vuePath;

    /** @var string */
    public $bladePath;

    /** @var string */
    public $controllerPath;

    /** @var string */
    public $classPathUrl;

    /** @var string */
    public $vuePathUrl;

    /** @var string */
    public $bladePathUrl;

    /** @var string */
    public $controllerPathUrl;

    /** @var string */
    public $classFileName;

    /** @var string */
    public $vueFileName;

    /** @var string */
    public $bladeFileName;

    /** @var string */
    public $controllerFileName;

    /** @var string */
    public $directory;

    /** Paths */
    const VUE_PATH = 'js/components'; //storage_path
    const VIEW_PATH = 'views';  //storage_path
    const CONTROLLER_PATH = 'Http/Controllers'; //app_path
    const MIGRATION_PATH = 'database/migrations';
    const PLURAL = 's';

    /** Used as placeholder in app.js */
    public $placeholder = "//------- CONTENT -------//";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do-not-run';

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
        //NOTE: Do not use this command.
    }

    /**
     * @param $file
     * @param $directory
     */
    public function setup($file, $directory){
        $this->setFileName($file);
        $this->setDirectoryName($directory);
        $this->setPaths();
    }

    /** UPDATED  5/29/2020        */
    /**
     * Generates a list vue component with table and pagination,
     * or a vue for a single component
     *
     * @param bool $useListView
     */
    public function addVueComponent($useListView = false){

        $vuePath = $this->vuePath;

        if($useListView){
            $vue = file_get_contents(resource_path('stubs/model_list_vue.stub'));
        }else{
            $vue = file_get_contents(resource_path('stubs/vue.stub'));
        }

        $vue = $this->replacePlaceholders($vue);
        file_put_contents($vuePath, $vue);
    }

    /** UPDATED 5/29/2020         */
    /**
     * Register a view component
     *
     */
    public function registerComponent($view = false){

        $kebab = Str::kebab($this->vueFileName);
        $fileName = $this->vueFileName;

        if($this->directory){
            $fileName  = strtolower($this->directory) . "s/" . $this->vueFileName;
        }

        $component = file_get_contents(resource_path('js/app.js'));
        $component = str_replace($this->placeholder, '', $component);
        $component .= "Vue.component('{$kebab}', require('./components/{$fileName}.vue').default);\n";
        $component .= $this->placeholder;

        file_put_contents(resource_path('js/app.js'), $component);

    }

    /** UPDATED  5/29/2020          */
    /**
     * Add route for a single controller
     *
     * @param bool $useListView
     */
    public function addRoute($method = 'get', $action = 'index'){

        $route = Str::kebab($this->file);
        $routeName = $this->controllerFileName;
        $controllerFileName = strtolower($this->controllerFileName);

        if($this->directory){
            $route = Str::kebab($this->file . $this->directory);
            $controllerFileName = strtolower($this->directory) . "s." . $route;
            $routeName = ucfirst($this->directory) . "s/" . $routeName;
        }

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "Route::{$method}('{$route}','{$routeName}Controller@{$action}')->name('{$controllerFileName}');\n";
        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /** UPDATED  5/29/2020        */
    /**
     * Add a controller in the appropriate directory
     */
    public function addController(){

        $controllerPath = $this->controllerPath;
        $this->hasDirectory($this->controllerPathUrl);

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = $this->replacePlaceholders($controller);

        file_put_contents($controllerPath, $controller);
    }

    /** UPDATED  5/29/2020       */
    /**
     * Add a class file
     */
    public function addClass(){
        $this->hasDirectory($this->classPathUrl);

        $class = file_get_contents(resource_path("stubs/class.stub"));
        $class = $this->replacePlaceholders($class);

        file_put_contents($this->classPath, $class);
    }

    /** UPDATED  5/29/2020       */
    /**
     * Add a request object
     * @param bool $update
     */
    public function addRequest($update = false){

        $file = ucfirst($this->classFileName);

        //if($this->directory){
            //$file .= ucfirst($this->directory);
        //}

        echo "FILE: $file\n";


        Artisan::call("make:request {$file}Request");

        if($update){
            Artisan::call("make:request {$file}UpdateRequest");
        }
    }

    /** UPDATED  5/30/2020          */
    /**
     * Add a migration to create a table
     */
    public function addTableMigration(){

        $timestamp = Carbon::now()->format('Y_m_d_h_') . 'create_table_';
        $fileName = $timestamp . strtolower($this->file) ."s.php";

        $migration = file_get_contents(resource_path("stubs/migration.stub"));
        $migration = $this->replacePlaceholders($migration);

        $filePath = self::MIGRATION_PATH . "/" . $fileName;

        file_put_contents($filePath, $migration);
    }


    /** UPDATED 5/28/2020         */
    /**
     * Add a blade
     */
    public function addBlade(){

        $this->hasDirectory($this->classPathUrl);
        $bladePath = $this->bladePath;

        $class = file_get_contents(resource_path("stubs/blade.stub"));
        $class = $this->replacePlaceholders($class);

        file_put_contents($bladePath, $class);
    }

    /** UPDATED  5/30/2020          */
    /**
     * Generate single controller routes
     */
    public function generateRoutes()
    {
        $route = Str::kebab($this->file);
        $routeName = Str::snake($this->vueFileName);
        $controllerFileName = strtolower($this->controllerFileName);
        $lowerCase = strtolower($this->file);

        if($this->directory){
            $route = Str::kebab($this->file . $this->directory);
            $controllerFileName = ucfirst($this->directory) . "s/" . ucfirst($this->file);
            $routeName = strtolower($this->directory) . "s." . $routeName;
        }

        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "/** {$this->fileName}  {$this->directory} **/\n";
        $contents .= "Route::get('{$route}s', '{$controllerFileName}Controller@index')->name('{$routeName}s');\n";
        $contents .= "Route::get('{$route}s/{{$lowerCase}}', '{$controllerFileName}Controller@index')->name('{$routeName}s');\n";
        $contents .= "Route::post('{$route}s', '{$controllerFileName}Controller@create')->name('{$routeName}s_create');\n";
        $contents .= "Route::patch('{$route}s/{{$lowerCase}}', '{$controllerFileName}Controller@update')->name('{$routeName}s_update');\n";
        $contents .= "Route::delete('{$route}s/{{$lowerCase}}', '{$controllerFileName}Controller@delete')->name('{$routeName}s_delete');\n";

        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /** UPDATED  5/30/2020          */
    /**
     * Generate single responsibility routes
     */
    public function generateSingleResponsibilityRoutes(){

        $route = Str::kebab($this->file);
        $routeName = Str::snake($this->vueFileName);
        $controllerFileName = ucfirst($this->controllerFileName);

        if($this->directory){
            $route = Str::kebab($this->file . $this->directory);
            $controllerFileName = ucfirst($this->directory) . "s/" . ucfirst($this->file);
            $routeName = strtolower($this->directory) . "s." . $routeName;
        }

        $path = base_path('routes/web.php');

        $contents = file_get_contents($path);
        $contents .= "/** {$this->fileName}   **/\n";
        $contents .= "Route::get('{$route}s-show', '{$controllerFileName}Controller@index')->name('{$routeName}s_show');\n";
        $contents .= "Route::post('{$route}s-create', '{$controllerFileName}ShowController@create')->name('{$routeName}s_create');\n";
        $contents .= "Route::patch('{$route}s-update', '{$controllerFileName}UpdateController@update')->name('{$routeName}s_update');\n";
        $contents .= "Route::delete('{$route}s-delete', '{$controllerFileName}AddController@delete')->name('{$routeName}s_delete');\n";

        file_put_contents($path, $contents);
    }

    /** UPDATED  5/30/2020          */
    /**
     * Generate single use controllers
     */
    public function generateSingleResponsibilityControllers(){

        $pathUrl = $this->controllerPathUrl;
        $controllerFileName = $this->controllerFileName;
        $fullPathToFile = $pathUrl . "/" . $controllerFileName;

        $index = file_get_contents(resource_path('stubs/index_controller.stub'));
        $index = $this->replacePlaceholders($index);
        file_put_contents("{$fullPathToFile}Controller.php", $index);

        $show = file_get_contents(resource_path('stubs/show_controller.stub'));
        $show = $this->replacePlaceholders($show);
        file_put_contents("{$fullPathToFile}ShowController.php", $show);

        $add = file_get_contents(resource_path('stubs/create_controller.stub'));
        $add = $this->replacePlaceholders($add);
        file_put_contents("{$fullPathToFile}AddController.php", $add);

        $update = file_get_contents(resource_path('stubs/update_controller.stub'));
        $update = $this->replacePlaceholders($update);
        file_put_contents("{$fullPathToFile}UpdateController.php", $update);

        $destroy = file_get_contents(resource_path('stubs/delete_controller.stub'));
        $destroy = $this->replacePlaceholders($destroy);
        file_put_contents("{$fullPathToFile}DestroyController.php", $destroy);
    }

    /******************************************************
     * Utility functions
     ******************************************************/

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

    public function setFileName($file){
        $this->file = $file;
    }

    public function setDirectoryName($directory = ''){
        $this->directory = $directory;
    }

    /**
     * Sets global fields
     */
    public function setPaths()
    {
        $this->vuePathGenerator();
        $this->viewPathGenerator();
        $this->classPathGenerator();
        $this->controllerPathGenerator();
    }

    /**
     * Called by setPaths function
     */
    public function vuePathGenerator(){

        $fileName = $this->generateFileName(true);
        $path = resource_path(self::VUE_PATH);
        $path = $this->generatePath($path, false, self::PLURAL);
        $this->hasDirectory($path);

        $this->vueFileName = $fileName;
        $this->vuePathUrl = $path;
        $this->vuePath = $path . "/$fileName.vue";
    }

    /**
     * Called by setPaths function
     */
    public function viewPathGenerator(){

        $fileName = $this->generateFileName(true);
        $path = resource_path(self::VIEW_PATH);
        $path = $this->generatePath($path, false, self::PLURAL);
        $this->hasDirectory($path);
        $snake = Str::snake($fileName);

        $this->bladeFileName = $fileName;
        $this->bladePathUrl = $path;
        $this->bladePath = $path . "/$snake.blade.php";
    }

    /**
     * Called by setPaths function
     */
    public function classPathGenerator(){

        $fileName = $this->generateFileName(true);
        $path = app_path(self::CONTROLLER_PATH);
        $path = $this->generatePath($path, true, self::PLURAL);
        $this->hasDirectory($path);

        $this->controllerFileName = $fileName;
        $this->controllerPathUrl = $path;
        $this->controllerPath = $path .= "/" . $fileName . "Controller.php";
    }

    /**
     * Called by setPaths function
     */
    public function controllerPathGenerator(){

        $fileName = $this->generateFileName(true);
        $path = app_path();
        $path = $this->generatePath($path, true, self::PLURAL);
        $this->hasDirectory($path);

        $this->classFileName = $fileName;
        $this->classPathUrl = $path;
        $this->classPath = $path .= "/" . $fileName . ".php";
    }

    /**
     * Generate the file name, upper case for components,
     * and lower case for vue and blade files
     *
     * @param bool $upperCase
     * @return string
     */
    public function generateFileName(bool $upperCase = false){

        $fileName = $this->file;

        if($this->directory){
            $fileName .= $upperCase ? ucfirst($this->directory) : strtolower($this->directory);
        }else{
            $fileName .= "-vue";
        }

        return $fileName;
    }

    /**
     * Generate path to url, upper case for classes,
     * and lower case for vue and blade files
     *
     * @param String $path
     * @param bool|null $upperCase
     * @param String|null $plural
     * @return string
     */
    public function generatePath(String $path, ?bool $upperCase = false, ?String $plural = null){

        if($this->directory){
            $path .= $upperCase ? ( "/" . ucfirst($this->directory) . $plural ) : ( "/" . strtolower($this->directory) . $plural );
        }

        return $path;
    }

    /**
     * Replace placeholders in stubs
     *
     * @param $stub
     * @return string|string[]
     */
    public function replacePlaceholders($stub){

        $vueFileName = $this->vueFileName;
        $classFileName = $this->classFileName;
        $vue = Str::kebab($vueFileName);

        if(!$this->directory){
            $vue .= "-vue";
        }

        $namespace = $this->directory ? "App\\" . ucfirst($this->directory) . "s" : 'App';
        $import = $this->directory ? "use App\\" . ucfirst($this->directory) . "s;" : '';

        $stub = str_replace('%CLASS%', $classFileName, $stub );
        $stub = str_replace('%VUE%', Str::kebab($vueFileName), $stub );
        $stub = str_replace('%NAMESPACE%', $namespace, $stub);
        $stub = str_replace('%IMPORT%', $import, $stub);
        $stub = str_replace('%class%', strtolower($vue), $stub);
        $stub = str_replace('%vue%', strtolower($this->file), $stub );

        $title = preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $classFileName);

        $stub = str_replace('%TITLE%', $title, $stub);
        $stub = str_replace('%COMPONENT%', Str::snake($classFileName), $stub);

        return $stub;

    }


    public function toString(){

        echo "\n\n*****************************************\n";
        echo "FULL CLASS PATH: $this->classPath\n";
        echo "FULL CONTROLLER PATH: $this->controllerPath\n";
        echo "FULL VIEW PATH: $this->bladePath\n";
        echo "FULL VUE PATH: $this->vuePath\n";

        echo "\n\nCLASS URL: $this->classPathUrl\n";
        echo "CONTROLLER URL: $this->controllerPathUrl\n";
        echo "VIEW URL: $this->bladePathUrl\n";
        echo "VUE URL: $this->vuePathUrl\n";

        echo "\n\nCLASS FILE NAME: $this->classFileName\n";
        echo "CONTROLLER FILE NAME: $this->controllerFileName\n";
        echo "VIEW FILE NAME: $this->bladeFileName\n";
        echo "VUE FILE NAME: $this->vueFileName\n";
    }

    /**
     * Write paths to routes when installing list view components
     */
    public function installUtilities(){
        //Vue.component('pagination', require('./components/utilities/Pagination.vue').default);
        //Vue.component('record-count', require('./components/utilities/RecordCount.vue').default);
    }


}

