return [
@foreach($columns as $column)
    '{{ $column }}' => 'required',
@endforeach
];