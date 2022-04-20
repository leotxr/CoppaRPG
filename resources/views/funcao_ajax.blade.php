<option value="">Selecione</option>
@foreach ($weapons as $weapon)
<option value="{{$weapon->id}}">{{$weapon->name}}</option>
@endforeach