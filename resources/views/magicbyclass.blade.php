<select enabled id="magic_id" name="magic_id" autocomplete="magic" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  <option>Selecione</option>
  @foreach($magics as $magic)
  <option value="{{$magic->id}}">{{$magic->name}}</option>
  @endforeach
</select>