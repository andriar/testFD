<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class apiGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Api CRUD';

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
           $name = $this->argument('name');
            $this->controller($name);
            $this->model($name); 
            $fp = fopen(base_path('routes/api.php'), 'a');
            fwrite($fp,
                "\n\n  Route::get('" . Str::plural(strtolower($name)) . "', '{$name}Controller@index');\n  Route::post('" . Str::plural(strtolower($name)) . "', '{$name}Controller@create');\n  Route::post('" . Str::plural(strtolower($name)) . "/bulk', '{$name}Controller@bulk');\n  Route::get('" . Str::plural(strtolower($name)) . "/{id}', '{$name}Controller@show');\n  Route::patch('" . Str::plural(strtolower($name)) . "/{id}', '{$name}Controller@update');\n  Route::delete('" . Str::plural(strtolower($name)) . "/{id}', '{$name}Controller@delete');");
                fclose($fp);  
    }

    protected function getStub($type){
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function controller($name){
        $controllerTemplate = str_replace([
            '{{modelName}}',
            '{{modelNamePlural}}',
            '{{modelNameSingular}}'
        ],
        [
            $name,
            strtolower(Str::plural($name)),
            strtolower($name)
        ],
    $this->getStub('Controller'));     
    file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function model($name){
    $modelTemplate = str_replace(
        ['{{modelName}}', '{{modelNamePlural}}'],
        [$name, strtolower(Str::plural($name))],
        $this->getStub('Model')
    );
    file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }
}
