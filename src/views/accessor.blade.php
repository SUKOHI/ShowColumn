@foreach($columns as $column)
public function {{ camel_case('get_'. $column .'_attribute') }}($value) {

    return $value;

}
@endforeach