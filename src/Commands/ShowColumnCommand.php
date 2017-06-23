<?php

namespace Sukohi\ShowColumn\Commands;

use Illuminate\Console\Command;

class ShowColumnCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:column 
                                {model : Eloquent model name} 
                                {type : `array`, `rule`, `getter`, `setter`, `request`, `js`, `seed` or `html`}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show automatically PHP/HTML code including DB table column';

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
        $class_name = $this->argument('model');
        $type = $this->argument('type');

        $types = [
            'array',
            'rule',
            'getter',
            'setter',
            'request',
            'js',
            'seed',
            'html'
        ];

        if(!in_array($type, $types)) {

            $this->error('[Error]: Only '. implode(',', $types) .' is available for code type.');
            die();

        }

        $model_name = $this->getClassName($class_name);

        if(!class_exists($model_name)) {

            $this->error('[Error] "'. $class_name .'" not found.');
            die();

        }

        $model = new $model_name();
        $table = $model->getTable();
        $columns = $this->getColumns($type, $table, $model);
        $code = $this->generateCode($type, $table, $columns, $model_name);
        $this->info($code);

    }

    private function getColumns($type, $table, $model) {

        $columns = \Schema::getColumnListing($table);

        if($type == 'getter') {

            $columns = array_merge($columns, $this->getAccessorAttributes($model));

        } else if($type == 'setter') {

            $columns = array_merge($columns, $this->getMutatorAttributes($model));

        }

        return $columns;

    }

    private function getClassName($class_name) {

        if(class_exists($class_name)) {

            return $class_name;

        }

        $class_name_with_app = '\\App\\'. $class_name;

        if(class_exists($class_name_with_app)) {

            return $class_name_with_app;

        }

        return '';

    }

    private function getAccessorAttributes($model) {

        $attributes = [];
        $methods = get_class_methods($model);

        foreach ($methods as $method) {

            if(preg_match('|^get(.+)Attribute$|', $method, $matches)) {

                $attributes[] = snake_case($matches[1]);

            }

        }

        return $attributes;

    }

    private function getMutatorAttributes($model) {

        $attributes = [];
        $methods = get_class_methods($model);

        foreach ($methods as $method) {

            if(preg_match('|^set(.+)Attribute$|', $method, $matches)) {

                $attributes[] = snake_case($matches[1]);

            }

        }

        return $attributes;

    }

    private function generateCode($type, $table, $columns, $model) {

        if(\View::exists('show-column::'. $type)) {

            return view('show-column::'. $type, compact('table', 'columns', 'model'))->render();

        }

    }
}
