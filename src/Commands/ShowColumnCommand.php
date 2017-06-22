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
                                {type : `array`, `rule`, `getter`, `setter`, `request`, `js` or `html`}';

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
            'html'
        ];

        if(!in_array($type, $types)) {

            $this->error('[Error]: Only '. implode(',', $types) .' is available for code type.');
            die();

        }

        $model = new $class_name;
        $table = $model->getTable();
        $columns = $this->getColumns($type, $table, $model);
        $code = $this->generateCode($type, $table, $columns);
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

    private function generateCode($type, $table, $columns) {

        if(\View::exists('show-column::'. $type)) {

            return view('show-column::'. $type, compact('table', 'columns'))->render();

        }

    }
//
//    public function generateArrayCode($columns) {
//
//        return view('show-column::array', compact('columns'))->render();
//
//    }
//
//    public function generateRuleCode($columns) {
//
//        return view('show-column::rule', compact('columns'))->render();
//
//    }
//
//    public function generateGetterCode($table, $columns) {
//
//        $code = '';
//
//        foreach ($columns as $column) {
//
//            $values[$column] = $column;
//            $code .= '$'. $column .' = $'. str_singular($table) .'->'. $column .';' ."\n";
//
//        }
//
//        return $code;
//
//    }
//
//    public function generateSetterCode($table, $columns) {
//
//        $code = '';
//
//        foreach ($columns as $column) {
//
//            $values[$column] = $column;
//            $code .= '$'. str_singular($table) .'->'. $column .' = $'. $column .';' ."\n";
//
//        }
//
//        return $code;
//
//    }
}
