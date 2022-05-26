<select enabled id="skill_id" name="skill_id" autocomplete="skill" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  <option>Selecione</option>
  @foreach($skills as $skill)
  <option value="{{$skill->id}}">Nv. {{$skill->level}} - {{$skill->name}}</option>
  @endforeach
</select>