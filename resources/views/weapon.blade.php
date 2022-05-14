@foreach($weapons as $weapon)
<tr id="modal_ext_weapons">
  <td class="relative px-2 py-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Nome da arma</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes sobre sua arma</p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Nome</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->name}}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Dano</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->damage}}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Descricao</dt>
            <dd class=" mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->desc}}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Modificador de Forca</dt>
            <input type="number" name="modstrwp" id="modstrwp" autocomplete="modstrwp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <div class="col-span-3 sm:col-span-1">
              <label for="observation" class="block text-sm font-bold text-gray-700">Observacoes</label>
              <input type="text" name="observation" id="observation" autocomplete="observation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>
          



      </div>
      </dl>
    </div>
    </div>
  </td>
</tr>

@endforeach