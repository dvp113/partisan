<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\RenderTable;
class CreateMVC extends Command
{
    protected   $templatePath   = '/resources/templates/';
    /*
     + templates
       - Controller.stub
       - Model.stub
       - View.stub
       + vendor
         + css
         + js
         + vendor
    */
    protected   $controllerPath = '/app/Http/Controllers/';
    protected   $modelPath      = '/app/';
    protected   $viewPath       = '/resources/views/';


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-mvc:controller {controllerName} {tableName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller Model View resource';

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
        //Create migration
        $table_name = $this->argument('tableName');
        $table_columns = $this->CreateMigration($table_name);
        if (!$table_columns)
        {
            $this->error('table '.$table_name.' not exist! Command fail!');
            return false;
        }

        //
        $full_path = $this->argument('controllerName');
        $file_attr = $this->parsePath($full_path);

        //Create Controller
        $this->createController($file_attr['file_dir'], $file_attr['file_name']);

        //Create Model
        $this->createModel($file_attr['file_name']);

        //Create View
        $this->createView($file_attr['file_name'], $table_columns);

        //Append Route
        $this->appendRoute($file_attr['file_dir'], $file_attr['file_name']);

        //Create Package
        $this->createPackage();
    }

    protected function parsePath($full_path)
    {
        $explode_path = explode('/', $full_path);
        $result['file_name'] = array_pop($explode_path);
        $result['file_dir'] = implode('/', $explode_path);

        return $result;
    }

    protected function createMigration($table_name)
    {
        if (!DB::getSchemaBuilder()->hasTable($table_name)){
            $this->error('table '.$table_name.' is not Exist');
            return false;
        }

        //get columns name & type
        $this->info('table '.$table_name.' is Exist');
        $columns_name = DB::getSchemaBuilder()->getColumnListing($table_name);
        $columns_type = [];
        foreach ($columns_name as $column_name) {
            $columns_type[] = DB::connection()->getDoctrineColumn($table_name, $column_name)->getType()->getName();
        }

        $columns = array_combine($columns_name, $columns_type);
        return $columns;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected function createController($file_dir, $file_name)
    {
        $file_name = ucfirst($file_name);
        if (file_exists(base_path().$this->controllerPath.$file_dir.'/'.$file_name.'Controller.php')){
            $this->error("Controller is Exist");
            return false;
        }

        $this->buildController($file_dir, $file_name);

        $this->info('Created controller ' . $file_name);
        return true;
    }

    protected function buildController($file_dir, $file_name)
    {
        $controller_name = $file_name.'Controller';
        $controller_content = str_replace(
            [
                '{{ControllerName}}','{{ModelName}}', '{{ViewName}}'
            ],
            [
                $controller_name, $file_name, lcfirst($file_name).'.index'
            ],
            file_get_contents(base_path().$this->templatePath.'/Controller.stub')
        );

        if (!is_dir(base_path().$this->controllerPath.$file_dir)) {
            mkdir(base_path().$this->controllerPath.$file_dir);
        }

        file_put_contents(base_path().$this->controllerPath.$file_dir.'/'.$file_name.'Controller.php',$controller_content);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected function createModel($model_name)
    {
        $file_name = ucfirst($model_name);
        if (file_exists(base_path().$this->modelPath.$file_name.'.php')) {
            $this->error('Model already exists!');
            return false;
        }

        $this->buildModel($file_name);

        $this->info($model_name . ' Model created');

        return true;
    }

    protected function buildModel($model_name)
    {
        $model_name = ucfirst($model_name);
        $table_name = lcfirst($model_name);
        $model_content = str_replace(
            [
                '{{ModelName}}','{{TableName}}'
            ],
            [
                $model_name, $table_name
            ],
            file_get_contents(base_path().$this->templatePath.'/Model.stub')
        );
        file_put_contents(base_path().$this->modelPath.$model_name.'.php',$model_content);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected function createView($view_name, Array $table_columns)
    {
        $view_folder = lcfirst($view_name);   //views/view_foler/index.blade.php
        $view_default = 'index.blade.php';
        $full_path_view = base_path().$this->viewPath.$view_folder.'/'.$view_default;
        if (file_exists($full_path_view)) {
            $this->error('View already exists!');
            return false;
        }

        $this->buildView($view_folder, $view_default, $table_columns);
        $this->info($view_folder.'/'.$view_default.' Created');
        return true;
    }

    protected function buildView($file_dir, $file_name, $table_columns)
    {
        $render = new RenderTable($table_columns);
        $datatable_th = $render->renderDataTableColumnHTML();
        $route = lcfirst($file_dir);
        $route_data = lcfirst($file_dir).'-data';
        $datatable_js = $render->renderDataTableColumnJS();
        $columns_name = json_encode(array_keys($render->getArrayKey()));
        $edit_form = $render->renderEditModalHTML();
        $view_content = str_replace(
            [
                '{{Title}}',
                '{{TableTH}}',
                '{{Route}}',
                '{{RouteGetData}}',
                '{{TableJS}}',
                '{{ColumnsName}}',
                '{{EditModal}}',
                '{{CreateModal}}',
            ],
            [
                ucfirst($file_dir),
                $datatable_th,
                $route,
                $route_data,
                $datatable_js,
                $columns_name,
                $edit_form,
                'Create Form'
            ],
            file_get_contents(base_path().$this->templatePath.'/View.stub')
        );

        if (!is_dir(base_path().$this->viewPath.$file_dir)) {
            mkdir(base_path().$this->viewPath.$file_dir);
        }

        file_put_contents(base_path().$this->viewPath.$file_dir.'/'.$file_name,$view_content);
    }



    protected function appendRoute($file_dir, $file_name)
    {
        $file_name = lcfirst($file_name);
        $controller_name = ucfirst($file_name).'Controller';
        $full_path = $file_dir == "" ? $controller_name : $file_dir.'\\'.$controller_name;

        $route_source = "Route::resource('$file_name', '$full_path');".PHP_EOL;
        $route_file = base_path().'/routes/web.php';
        file_put_contents($route_file, $route_source.PHP_EOL , FILE_APPEND);

        $this->extendRoute($file_name, $full_path);
    }

    protected function extendRoute($file_name, $full_path)
    {
        $route_data   = "//get data for nodes".PHP_EOL.
            "Route::get('$file_name-data', '$full_path@getData')->name('$file_name-data');";

        $route_file = base_path().'/routes/web.php';
        file_put_contents($route_file, $route_data.PHP_EOL , FILE_APPEND);

        return true;
    }
    protected function createPackage()
    {
        $package_source = base_path().$this->templatePath."vendor/";
        $package_destination = base_path().'/public/';

        $package_type = ['css', 'js', 'vendor'];
        foreach ($package_type as $value){
            $source       = $package_source.$value;
            $destination  = $package_destination.$value;

            $this->recurseCopy($source, $destination);
        }
        return true;

    }

    protected function recurseCopy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurseCopy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /*==========HELPER============*/
}
