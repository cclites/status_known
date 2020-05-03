<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClassFactory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:class {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate boilerplate for a class';

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
        $class = $this->argument('class');

        $lowercaseClassName = strtolower($class);
        $formattedClassName = ucfirst($lowercaseClassName);

        //Make a model
        $class = file_get_contents(resource_path('stubs/class.stub'));
        $class = str_replace('%MODEL%', $formattedClassName, $class);
        file_put_contents(app_path("{$formattedClassName}.php"), $class);

        //make a controller
        $controller = file_get_contents(resource_path('stubs/controller.stub'));
        $controller = str_replace('%MODEL%', $formattedClassName, $controller);
        $controller = str_replace('%model%', $lowercaseClassName, $controller);
        file_put_contents(app_path("Http/Controllers/{$formattedClassName}Controller.php"), $controller);

        //make a vue
        $path = resource_path('js/components');
        $vue = file_get_contents(resource_path('stubs/vue.stub'));
        $path .= "/{$formattedClassName}.vue";
        file_put_contents($path, $vue);

        //Add Route
        $contents = file_get_contents(base_path('routes/web.php'));
        $contents .= "\r\n";
        $contents .= "Route::get('{$lowercaseClassName}', '{$formattedClassName}Controller@index');\r\n";
        file_put_contents(base_path('routes/web.php'), $contents);


        //register controller
        $appJs = file_get_contents(resource_path('js/app.js'));
        $placeholder = $this->placeholder;

        $component = "\r\nVue.component('{$formattedClassName}-vue', require('./components/{$formattedClassName}.vue'));\r\n";
        $component .= $placeholder;

        $appJs = str_replace($placeholder, $component, $appJs);

        file_put_contents(resource_path('js/app.js'), $appJs);


    }
}
