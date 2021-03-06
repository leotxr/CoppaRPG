@foreach($weapons as $weapon)
<tr id="modal_ext_weapons" >
  <td class="relative px-2 py-6">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{$weapon->name}}</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes sobre sua arma</p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Bonus Base de Ataque</dt>
            <dd class=" mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->bba_total}}</dd>
          </div>

          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Dano</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->damage}}</dd>
          </div>

          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Sucesso Decisivo</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->decisive}}</dd>
          </div>

          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Alcance</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->reach}}</dd>
          </div>
          
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Tipo</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->type}}</dd>
          </div>

          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Observacao</dt>
            <dd class=" mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->observation}}</dd>
          </div>

          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Descricao</dt>
            <dd class=" mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$weapon->desc}}</dd>
          </div>

          </div>
        </dl>
      </div>
    </div>
  </td>
</tr>

@endforeach