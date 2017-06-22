// Basic
@foreach($columns as $column)
var {{ camel_case($column) }} = {{ camel_case(str_singular($table)) .'.'. camel_case($column) }};
@endforeach

// Vue
@foreach($columns as $column)
this.{{ camel_case($column) }} = {{ camel_case(str_singular($table)) .'.'. camel_case($column) }};
@endforeach