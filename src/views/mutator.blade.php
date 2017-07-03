@foreach($columns as $column)
public function {{ camel_case('set_'. $column .'_attribute') }}($value) {

    $this->attributes['{{ $column }}'] = $value;

}
@endforeach