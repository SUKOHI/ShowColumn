$array = [
@foreach($columns as $column)
    '{{ $column }}' => '{{ $column }}',
@endforeach
];