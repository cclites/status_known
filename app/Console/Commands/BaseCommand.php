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
    public $name;

    /** @var string */
    public $directory;

    /** @var string */
    public $lcDirectory;

    /** @var string */
    public $lcDirectorySingular;

    /** @var string */
    public $ucDirectorySingular;

    /** @var string */
    public $originalDirectory;

    /** @var string */
    public $snakeSuffix;

    /** @var string */
    public $kebabSuffix;

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
        //Unused
    }


    /** TESTED  5/11/2020        */
    /**
     * Add a generic vue component
     */
    public function addVueComponent($useListView = false){

        $path = resource_path('js/components/' . $this->lcDirectory . "/");
        $this->hasDirectory($path);

        if($useListView){
            $vue = file_get_contents(resource_path('stubs/model_list_vue.stub'));
        }else{
            $vue = file_get_contents(resource_path('stubs/vue.stub'));
        }

        $vue = str_replace('%MODEL%', $this->itemName, $vue);
        $vue = str_replace('%model%', $this->kebabCase, $vue);
        $vue = str_replace('%directory%', $this->lcDirectory, $vue);

        file_put_contents($path . $this->kebabCase . "s-" . $this->lcDirectory . ".vue", $vue);
    }

    /** TESTED 5/11/2020         */
    /**
     * Register a view component
     *
     * @param bool $useListView
     */
    public function registerComponent($useListView = false){

        $appJs = file_get_contents(resource_path('js/app.js'));

        $component = "Vue.component('{$this->kebabCase}s-{$this->lcDirectory}',
                        require('./components/{$this->lcDirectory}/{$this->snakeCase}s_{$this->lcDirectory}.vue'));\n";

        $component .= $this->placeholder;

        $appJs = str_replace($this->placeholder, $component, $appJs);

        file_put_contents(resource_path('js/app.js'), $appJs);

    }

    /** TESTED  5/11/2020          */
    /**
     * Add route for controller
     *
     * @param bool $useListView
     */
    public function addRoute($useListView = false, $method = 'get', $action = 'index'){

        $contents = file_get_contents(base_path('routes/web.php'));

        $contents .= "\nRoute::{$method}('{$this->kebabCase}s-{$this->lcDirectory}',
                        '{$this->directory}{$this->itemName}s{$this->originalDirectory}Controller@index')->name('{$this->snakeCase}s_{$this->lcDirectory}');";

        file_put_contents(base_path('routes/web.php'), $contents);
    }


    /** TESTED  5/12/2020        */
    /**
     * Add a controller in the appropriate directory
     */
    public function addController(){

        $fileName = $this->itemName . "s". $this->ucDirectorySingular ."Controller.php";
        $path = "app/Http/Controllers/{$this->upperCase}/";
        $fullTitle = $path . $fileName;

        $this->hasDirectory($path);

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', "{$this->upperCase}s{$this->originalDirectory}", $controller);
        $controller = str_replace('%model%', $this->kebabCase, $controller);
        $controller = str_replace('%NAMESPACE%', ('\\' . $this->itemName), $controller);
        $controller = str_replace('%directory%', $this->lcDirectory, $controller);
        $controller = str_replace('%request%', "{$this->upperCase}s{$this->originalDirectory}", $controller);

        file_put_contents($fullTitle, $controller);
    }



    /** TESTED  5/12/2020       */
    /**
     * Add a class file
     */
    public function addClass(){

        $fileName = $this->itemName .".php";
        $path = "app/{$this->upperCase}s/";
        $fullTitle = $path . $fileName;

        $this->hasDirectory($path);

        $class = file_get_contents(resource_path("stubs/class.stub"));

        $class = str_replace('%MODEL%', $this->itemName, $class);
        $class = str_replace('%model%', $this->kebabCase, $class);
        $class = str_replace('%NAMESPACE%', ('\\' . $this->itemName), $class);

        file_put_contents($fullTitle, $class);
    }

    /** TESTED  5/12/2020       */
    /**
     * Add a request object
     * @param bool $update
     */
    public function addRequest($update = false){

        Artisan::call("make:request {$this->upperCase}s{$this->originalDirectory}Request");

        if($update){
            Artisan::call("make:request {$this->upperCase}s{$this->originalDirectory}UpdateRequest");
        }
    }

    /** TESTED  5/12/2020          */
    /**
     * Add a migration to create a table
     */
    public function createTableMigration(){

        $timestamp = Carbon::now()->format('Y_m_d_' . '000000_') . 'create_table_';
        $fileName = $timestamp . $this->lowerCase ."s.php";

        $path = "database/migrations/";

        $fullTitle = $path . $fileName;

        $this->hasDirectory($path);

        $migration = file_get_contents(resource_path("stubs/migration.stub"));

        $migration = str_replace('%MODEL%', $this->itemName, $migration);
        $migration = str_replace('%model%', $this->kebabCase . "s", $migration);

        file_put_contents($fullTitle, $migration);

    }





    /** TESTED          */
    public function addBlade(){

        if($this->directory){
            $this->hasDirectory(resource_path("views/$this->lowerCase") . "s");
            $this->lcDirectory .= "/";
        }

        $blade = file_get_contents(resource_path('stubs/blade.stub'));
        $blade = str_replace('%MODEL%', $this->lcDirectorySingular, $blade);
        $blade = str_replace('%model%', $this->lowerCase, $blade);
        $path = resource_path("views/" . $this->lowerCase) . "s/". $this->snakeCase . "s" . $this->snakeSuffix. '.blade.php';

        file_put_contents($path, $blade);
    }

    /** TESTED  5/12/2020          */
    /**
     * Generate single controller routes
     */
    public function generateRoutes()
    {
        $path = base_path('routes/web.php');

        $contents = file_get_contents($path);

        $contents .= "/**  {$this->originalDirectory} Routes  **/\n";

        $contents .= "Route::get('{$this->kebabCase}s-show', '{$this->directory}{$this->itemName}s{$this->originalDirectory}Controller@index')->name('{$this->snakeCase}s_show');\n";

        $contents .= "Route::post('{$this->kebabCase}s-create', '{$this->directory}{$this->itemName}s{$this->originalDirectory}Controller@index')->name('{$this->snakeCase}s_create');\n";

        $contents .= "Route::patch('{$this->kebabCase}s-update', '{$this->directory}{$this->itemName}s{$this->originalDirectory}Controller@index')->name('{$this->snakeCase}s_update');\n";

        $contents .= "Route::delete('{$this->kebabCase}s-delete', '{$this->directory}{$this->itemName}s{$this->originalDirectory}Controller@index')->name('{$this->snakeCase}s_delete');\n";


        file_put_contents($path, $contents);
    }


    /** TESTED  5/12/2020          */
    /**
     * Generate single responsibility routes
     */
    public function generateSingleResponsibilityRoutes(){

        $path = base_path('routes/web.php');

        $contents = file_get_contents($path);

        $contents .= "/** {$this->itemName}   **/\n";
        $contents .= "Route::get('{$this->kebabCase}s-show', '{$this->itemName}sController@index')->name('{$this->snakeCase}s_show');\n";
        $contents .= "Route::post('{$this->kebabCase}s-create', '{$this->itemName}sController@create')->name('{$this->snakeCase}s_create');\n";
        $contents .= "Route::patch('{$this->kebabCase}s-update', '{$this->itemName}sController@update')->name('{$this->snakeCase}s_update');\n";
        $contents .= "Route::delete('{$this->kebabCase}s-delete', '{$this->itemName}sController@delete')->name('{$this->snakeCase}s_delete');\n";

        file_put_contents($path, $contents);
    }

    /** TESTED  5/12/2020          */
    /**
     * Generate single use controllers
     */
    public function generateSingleUseControllers(){

        $this->hasDirectory(app_path("Http/Controllers/{$this->directory}{$this->upperCase}"));

        $path = "Http/Controllers/{$this->directory}{$this->upperCase}";

        $index = file_get_contents(resource_path('stubs/index.stub'));
        $index .= str_replace('%MODEL%', $this->upperCase, $index);
        file_put_contents("{$path}Controller.php", $index);

        $show = file_get_contents(resource_path('stubs/show.stub'));
        $show .= str_replace('%MODEL%', $this->upperCase, $show);
        $show .= str_replace('%model%', $this->lowerCase, $show);
        file_put_contents("{$path}ShowController.php", $show);

        $add = file_get_contents(resource_path('stubs/create.stub'));
        $add .= str_replace('%MODEL%', $this->upperCase, $add);
        file_put_contents("{$path}AddController.php", $add);

        $update = file_get_contents(resource_path('stubs/update.stub'));
        $update .= str_replace('%MODEL%', $this->upperCase, $update);
        file_put_contents("{$path}UpdateController.php", $update);

        $destroy = file_get_contents(resource_path('stubs/destroy.stub'));
        $destroy .= str_replace('%MODEL%', $this->upperCase, $destroy);
        file_put_contents("{$path}UpdateController.php", $destroy);
    }

    /** TESTED          */
    /**
     * Shouldn't need this function at all
     */
    public function addModelListRoute(){

        $contents = file_get_contents(base_path('routes/web.php'));

        $contents .= "\nRoute::get('{$this->kebabCase}{$this->kebabSuffix}',
                        '{$this->directory}{$this->upperCase}{$this->originalDirectory}Controller@index');";

        file_put_contents(base_path('routes/web.php'), $contents);
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

    public function setItemName($itemName){

        $this->itemName = $itemName;
        $this->lowerCase = strtolower($this->itemName);
        $this->upperCase = ucfirst($this->itemName);
        $this->kebabCase = Str::kebab($this->itemName);
        $this->snakeCase = Str::snake($this->itemName);
    }

    public function setDirectoryName($directory = ''){

        $this->directory = $directory;
        $this->originalDirectory = $directory;
        $this->directory = $directory ? $this->directory .= "/" : "";
        $this->snakeSuffix = $directory ? ("_" . rtrim(Str::snake($this->originalDirectory), 's')) : "";
        $this->kebabSuffix = $directory ? ("-" . rtrim(Str::kebab($this->originalDirectory), 's')) : "";
        $this->lcDirectory = $directory ? (strtolower($this->originalDirectory)) : "";
        $this->lcDirectorySingular = $directory ? rtrim($this->lcDirectory, 's') : "";
        $this->ucDirectorySingular  = $directory ? rtrim($this->originalDirectory, 's') : "";
    }

    public function setup($itemName, $directory){

        $this->setItemName($itemName);
        $this->setDirectoryName($directory);
    }


}

