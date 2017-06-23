// Variable
${{ str_singular($table) }} = new {{ $model }}();
@foreach($columns as $column)
@if(!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at']))
${{ str_singular($table) }}->{{ $column }} = ${{ $column }};
@endif
@endforeach
${{ str_singular($table) }}->save();

// Request
${{ str_singular($table) }} = new {{ $model }}();
@foreach($columns as $column)
@if(!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at']))
${{ str_singular($table) }}->{{ $column }} = $request->{{ $column }};
@endif
@endforeach
${{ str_singular($table) }}->save();