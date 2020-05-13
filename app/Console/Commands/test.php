<?php

namespace App\Console\Commands;

class Test extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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

        $this->setup($this->argument('vue'), $this->argument('directory'));

        $this->testAddRoute();
        //$this->testRegisterComponent();
        //$this->testAddComponent();
        //$this->testAddView();
        //$this->testAddController();
        //$this->testAddBlade();
        //$this->testAddRequest();
        //$this->testMakeMigration();
        //$this->testGenerateSingleUseRoutes();
        //$this->testGenerateSingleUseControllers();
        //$this->testAddClass();


        $this->setDirectory('Views');
        //$this->testAddRoute();
        //$this->testRegisterComponent();
        //$this->testAddComponent();
        //$this->testAddView();
        //$this->testAddController();
        //$this->testAddBlade();
        //$this->testAddRequest();
        //$this->testMakeMigration();
        //$this->testGenerateSingleUseRoutes();
        //$this->testGenerateSingleUseControllers();
        //$this->testAddClass();


        $this->setDirectory();
        //$this->testAddRoute();
        //$this->testRegisterComponent();
        //$this->testAddComponent();
        //$this->testAddView();
        //$this->testAddController();
        //$this->testAddBlade();
        //$this->testAddRequest();
        //$this->testMakeMigration();
        //$this->testGenerateSingleUseRoutes();
        //$this->testGenerateSingleUseControllers();
        //$this->testAddClass();


    }

    public function testAddRoute(){

        $contents = "Route::get('{$this->kebabCase}{$this->kebabSuffix}', '{$this->directory}{$this->upperCase}{$this->originalDirectory}Controller@index');";

        echo $contents . "\n";

    }

    public function testRegisterComponent(){

        $component = "Vue.component('{$this->kebabCase}{$this->kebabSuffix}', require('./components/{$this->lcDirectory}{$this->snakeCase}{$this->snakeSuffix}.vue'));";
        //$component .= $this->placeholder;

        echo $component . "\n";
    }

    public function testAddComponent(){
        if($this->directory){
            $this->hasDirectory(resource_path('js/components/' . $this->lcDirectory));
        }

        $path = resource_path('js/components/' . $this->lcDirectory);
        $path .= "{$this->itemName}.vue";

        echo $path . "\n";
    }

    public function testAddView(){

        if($this->directory){
            $this->hasDirectory(resource_path("js/components/{$this->lcDirectory}"));
            $this->lcDirectory .= "/";
        }

        $path = resource_path('js/components/' . $this->lcDirectory );
        $path .= "{$this->upperCase}.vue";

        echo $path . "\n";
    }

    public function testAddController(){

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

        echo $controller . "\n";
    }

    public function testAddBlade(){

        if($this->directory){
            $this->hasDirectory(resource_path("views/$this->directory"));
            $this->lcDirectory .= "/";
        }

        $path = resource_path("views/" . $this->lcDirectory) . $this->snakeCase . $this->snakeSuffix. '.blade.php';
        echo "$path\n";

    }

    public function testAddRequest(){

        echo "make:request {$this->upperCase}{$this->originalDirectory}Request\n";

        //Artisan::call("make:request {$this->upperCase}{$this->originalDirectory}Request");
    }

    public function testMakeMigration(){

        echo "make:migration make_table_{$this->snakeCase}s  --table={$this->snakeCase}s" . "\n";
    }


    public function testAddClass(){

        $class = file_get_contents(resource_path("stubs/class.stub"));
        $controller = str_replace('%MODEL%', $this->itemName, $class);
        $controller = str_replace('%model%', $this->kebabCase, $controller);

        $temporary = "\\" . $this->originalDirectory;
        $controller = str_replace('%NAMESPACE%', $temporary, $controller);

        echo $controller . "\n";

    }

    public function testGenerateSingleUseRoutes(){

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

        echo "$contents\n";
    }

    public function testGenerateSingleUseControllers(){

        $path = "Http/Controllers/{$this->directory}{$this->upperCase}";

        echo app_path("{$path}Controller.php") . "\n";
        //file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}Controller.php"), $index);

        echo app_path("{$path}ShowController.php") . "\n";
        //file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}ShowController.php"), $show);

        echo app_path("{$path}AddController.php") . "\n";
        //file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}AddController.php"), $add);

        echo app_path("{$path}UpdateController.php") . "\n";
        //file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}UpdateController.php"), $update);

        echo app_path("{$path}DeleteController.php") . "\n";
        //file_put_contents(app_path("Http/Controllers/{$this->upperCase}/{$this->upperCase}UpdateController.php"), $destroy);
    }
}
