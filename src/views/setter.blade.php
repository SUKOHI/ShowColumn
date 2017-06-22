// Variable
@foreach($columns as $column)
${{ str_singular($table) }}->{{ $column }} = ${{ $column }};
@endforeach
${{ $table }}->save();

// Request
@foreach($columns as $column)
${{ str_singular($table) }}->{{ $column }} = $request->{{ $column }};
@endforeach
${{ $table }}->save();