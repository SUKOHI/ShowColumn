<!-- Empty -->
@foreach($columns as $column)
<input type="text" name="{{ $column }}" value="">
@endforeach

<!-- with Values -->
@foreach($columns as $column)
<input type="text" name="{{ $column }}" value="{!! '{'.'{ $'. str_singular($table) .'->'. $column .' }'.'}' !!}">
@endforeach

<!-- Vue -->
@foreach($columns as $column)
<input type="text" name="{{ $column }}" v-model="{{ camel_case($column) }}">
@endforeach