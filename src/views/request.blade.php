@foreach($columns as $column)
${{ $column }} = $request->{{ $column }};
@endforeach