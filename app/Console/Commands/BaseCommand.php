<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;


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
        //Unused
    }


    /** TESTED          */
    /**
     *
     */
    public function addVueComponent(){

        if($this->directory){
            $this->hasDirectory(resource_path('js/components/' . $this->lcDirectory));
        }

        $path = resource_path('js/components/' . $this->lcDirectory);
        $path .= "{$this->itemName}.vue";
        $vue = file_get_contents(resource_path('stubs/vue.stub'));

        file_put_contents($path, $vue);
    }

    /** TESTED          */
    /**
     * Add a controller in the appropriate directory
     */
    public function addController(){

        if($this->directory){
            $this->hasDirectory(app_path("Http/Controllers/{$this->directory}"));
        }

        $path = app_path("Http/Controllers/{$this->directory}");

        if($this->directory){
            rtrim($path, '/');
        }

        $path .= $this->itemName . $this->ucDirectorySingular ."Controller.php\n";

        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $this->itemName, $controller);
        $controller = str_replace('%model%', $this->kebabCase, $controller);
        $controller = str_replace('%NAMESPACE%', $this->directory, $controller);

        file_put_contents($path, $controller);
    }



    /** TESTED          */
    /**
     * Add a class file
     */
    public function addClass(){

        if($this->originalDirectory == 'Reports'){
            $class = file_get_contents(resource_path("stubs/report_class.stub"));
        }
        else{
            $class = file_get_contents(resource_path("stubs/class.stub"));
        }

        $class = str_replace('%MODEL%', $this->itemName, $class);
        $class = str_replace('%model%', $this->kebabCase, $class);

        $temporary = "\\" . $this->originalDirectory;
        $class = str_replace('%NAMESPACE%', $temporary, $class);

        file_put_contents(app_path("{$this->directory}{$this->itemName}.php"), $class);
    }

    /** TESTED          */
    public function registerComponent(){

        $appJs = file_get_contents(resource_path('js/app.js'));

        $component = "Vue.component('{$this->kebabCase}{$this->kebabSuffix}',
                        require('./components/{$this->lcDirectory}{$this->snakeCase}{$this->snakeSuffix}.vue'));\n";
        $component .= $this->placeholder;

        $appJs = str_replace($this->placeholder, $component, $appJs);
        file_put_contents(resource_path('js/app.js'), $appJs);

    }

    /** TESTED          */
    public function addRoute(){

        $contents = file_get_contents(base_path('routes/web.php'));

        $contents .= "\nRoute::get('{$this->kebabCase}{$this->kebabSuffix}',
                        '{$this->directory}{$this->upperCase}{$this->originalDirectory}Controller@index');";

        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /** TESTED          */
    public function addBlade(){

        if($this->directory){
            $this->hasDirectory(resource_path("views/$this->directory"));
            $this->lcDirectory .= "/";
        }

        $blade = file_get_contents(resource_path('stubs/blade.stub'));
        $blade = str_replace('%model%', $this->lowerCase, $blade);
        $path = resource_path("views/" . $this->lcDirectory) . $this->snakeCase . $this->snakeSuffix. '.blade.php';

        file_put_contents($path, $blade);
    }

    /** TESTED          */
    public function addRequest($update = false){
        Artisan::call("make:request {$this->upperCase}{$this->originalDirectory}Request");

        if($update){
            Artisan::call("make:request {$this->upperCase}{$this->originalDirectory}UpdateRequest");
        }
    }

    /** TESTED          */
    public function makeMigration(){
        Artisan::call("make:migration make_table_{$this->snakeCase}s  --table={$this->snakeCase}s");
    }

    /** TESTED          */
    public function generateSingleUseRoutes(){

        $contents = file_get_contents(base_path('routes/web.php'));

        $path = "{$this->kebabCase}s{$this->kebabSuffix}";
        $filePath = "{$this->originalDirectory}";

        if($this->directory){
            $binding = "/{" . $this->lcDirectorySingular . "}";
        }else{
            $binding='';
        }

        $contents = "/**  {$this->originalDirectory} Single Use Routes  **/\n";
        $contents .= "Route::get('{$path}', '{$filePath}Controller@index');\n";
        $contents .= "Route::get('{$path}{$binding}', '{$filePath}ShowController@show');\n";
        $contents .= "Route::post('{$path}', '{$filePath}AddController@store');\n";
        $contents .= "Route::patch('{$path}', '{$filePath}UpdateController@update');\n";
        $contents .= "Route::delete('{$path}', '{$filePath}DeleteController@delete');\n";

        file_put_contents(base_path('routes/web.php'), $contents);
    }

    /** TESTED          */
    public function generateSingleUseControllers(){

        $this->hasDirectory(app_path("Http/Controllers/{$this->directory}{$this->upperCase}"));

        $path = "Http/Controllers/{$this->directory}{$this->upperCase}";

        $index = file_get_contents(resource_path('stubs/index.stub'));
        $index = str_replace('%MODEL%', $this->upperCase, $index);
        file_put_contents("{$path}Controller.php", $index);

        $show = file_get_contents(resource_path('stubs/show.stub'));
        $show = str_replace('%MODEL%', $this->upperCase, $show);
        $show = str_replace('%model%', $this->lowerCase, $show);
        file_put_contents("{$path}ShowController.php", $show);

        $add = file_get_contents(resource_path('stubs/create.stub'));
        $add = str_replace('%MODEL%', $this->upperCase, $add);
        file_put_contents("{$path}AddController.php", $add);

        $update = file_get_contents(resource_path('stubs/update.stub'));
        $update = str_replace('%MODEL%', $this->upperCase, $update);
        file_put_contents("{$path}UpdateController.php", $update);

        $destroy = file_get_contents(resource_path('stubs/destroy.stub'));
        $destroy = str_replace('%MODEL%', $this->upperCase, $destroy);
        file_put_contents("{$path}UpdateController.php", $destroy);
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

    public function setDirectory($directory = ''){

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
        $this->setItemName = $itemName;
        $this->setDirectory($directory);
    }


}

