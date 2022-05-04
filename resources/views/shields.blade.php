@foreach($shields as $shield)
<tr id="modal_ext_weapons" >
  <td class="relative px-2 py-6 whitespace-nowrap">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Nome do Escudo</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes sobre seu Escudo</p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Nome</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$shield->name}}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Bonus na CA</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$shield->ca_bonus}}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Descricao</dt>
            <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$shield->desc}}</div>
          </div>

          </div>
        </dl>
      </div>
    </div>
  </td>
</tr>



@endforeach