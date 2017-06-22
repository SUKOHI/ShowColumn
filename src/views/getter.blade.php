@foreach($columns as $column)
${{ $column }} = ${{ str_singular($table) }}->{{ $column }};
@endforeach