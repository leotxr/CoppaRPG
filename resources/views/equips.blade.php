 <!--HABILIDADES TALENTOS E MAGIAS-->

 <div id="specials" class="specials" style="display: block">
     <!-- TALENTOS -->
     <div class="py-12" id="talentos">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

                     <div class="mt-10 sm:mt-0">
                         <div class="md:grid md:grid-cols-3 md:gap-6">
                             <div class="md:col-span-1">
                                 <div class="px-4 sm:px-0">
                                     <h3 class="text-lg font-medium leading-6 text-gray-900">Talentos</h3>
                                     <p class="mt-1 text-sm text-gray-600">
                                         Talentos do personagem
                                     </p>
                                 </div>
                             </div>
                             <div class="mt-5 md:mt-0 md:col-span-2">
                                 <!-- SELECT TALENTOS -->

                                 <div class="shadow overflow-hidden sm:rounded-md">
                                     <div class="px-4 py-5 bg-white sm:p-6">
                                         <div class="grid grid-cols-6 gap-6">
                                             <div class="col-span-6 sm:col-span-3">
                                                 <label for="talents" class="block text-sm font-medium text-gray-700">Talentos</label>
                                                 <select enabled id="talent_id" name="talent_id" autocomplete="weapon" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                     <option>Selecione</option>
                                                     @foreach($talents as $talent)
                                                     <option value="{{$talent->id}}">{{$talent->name}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <button type="button" id="showinfoweapon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray" stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                 </svg>
                                             </button>
                                         </div>
                                     </div>

                                     <!-- AJAX PARA MOSTRAR O SELECT COM AS INFORMACOES DA ARMA SELECIONADA -->
                                     <script>
                                         $(document).ready(function() {
                                             $("#showinfotalents").click(function() {
                                                 const url = "{{ route('load_talent')}}";
                                                 talentId = $("#talent_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'talent_id': talentId,
                                                     },
                                                     success: function(data) {
                                                         $("#talentinfo").html(data);

                                                     }

                                                 });
                                             });

                                             $("#addtalent").click(function() {
                                                 const url = "{{ route('add_talent')}}";
                                                 talentId = $("#talent_id").val();

                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'talent_id': talentId,

                                                     },
                                                     success: function(data) {
                                                         alert("Talento aprendido!");
                                                     }

                                                 });
                                             });

                                         });
                                     </script>

                                     <!-- INFORMAÇÕES SAO MOSTRADAS NESTA DIV -->
                                     <div id="talentinfo">

                                     </div>

                                     <!-- BOTAO MOSTRAR MINHAS ARMAS -->
                                     <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse ">
                                         <button type="button" onclick="mostrarModalTalentos()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                             Talentos aprendidos
                                         </button>
                                     </div>


                                     <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse">
                                         <button id="addtalent" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                             Adicionar
                                         </button>
                                     </div>

                                     <!-- INICIO MODAL MEUS TALENTOS -->
                                     <div id="modal_talents" class="fixed z-10 inset-0 overflow-y-auto bg-opacity-75" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                                         <div class="flex items-end justify-center min-h-screen pt-10 px-10 pb-20 text-center sm:block sm:p-0">

                                             <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                             <!-- This element is to trick the browser into centering the modal contents. -->
                                             <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                             <div class="relative inline-block align-bottom bg-white rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                 <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                     <div class="sm:flex sm:items-start">
                                                         <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                             <!-- Heroicon name: outline/exclamation -->
                                                             <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                             </svg>
                                                         </div>
                                                         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-center">
                                                             <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Talentos</h3>
                                                             <div class="mt-2">
                                                                 @if (isset($char))
                                                                 <div class="px-4 py-5 bg-white sm:p-6">
                                                                     <div class="grid grid-cols-6 gap-6">
                                                                         <div class="col-span-6 sm:col-span-6">
                                                                             <select id="mytalent_id" name="mytalent_id" autocomplete="talent" class="mt-1 block w-full py-2 px-50 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-x">
                                                                                 <option>Selecione</option>
                                                                                 @foreach ($char->talents as $talent)
                                                                                 <option value="{{$talent->id}}">{{$talent->name}}</option>
                                                                                 @endforeach
                                                                             </select>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 @else
                                                                 <label>Voce ainda nao tem talentos...!</label>
                                                                 @endif
                                                                 <div id="mytalentinfo">

                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                     <button type="button" id="deletemytalent" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Excluir</button>
                                                     <button type="button" id="showmytalent" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-indigo-400 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Visualizar</button>
                                                     <button type="button" onclick="mostrarModalTalentos()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Fechar</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <script>
                                         $(document).ready(function() {
                                             $("#showmytalent").click(function() {
                                                 const url = "{{ route('load_mytalent')}}";
                                                 myTalentId = $("#mytalent_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'mytalent_id': myTalentId,
                                                     },
                                                     success: function(data) {
                                                         $("#mytalentinfo").html(data);
                                                     }

                                                 });
                                             });
                                         });

                                         $(document).ready(function() {
                                             $("#deletemytalent").click(function() {
                                                 const url = "{{ route('delete_mytalent')}}";
                                                 myTalentId = $("#mytalent_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'mytalent_id': myTalentId,
                                                     },
                                                     success: function(data) {
                                                         alert("Talento removido com sucesso!");
                                                         location.reload();
                                                     }

                                                 });
                                             });
                                         });
                                     </script>
                                     <!-- Fim Modal -->

                                 </div>


                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- ARMAS -->
     <div class="py-12" id="armas">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

                     <div class="mt-10 sm:mt-0">
                         <div class="md:grid md:grid-cols-3 md:gap-6">
                             <div class="md:col-span-1">
                                 <div class="px-4 sm:px-0">
                                     <h3 class="text-lg font-medium leading-6 text-gray-900">Armamento</h3>
                                     <p class="mt-1 text-sm text-gray-600">
                                         Armas do personagem
                                     </p>
                                 </div>
                             </div>
                             <div class="mt-5 md:mt-0 md:col-span-2">
                                 <!-- SELECT ARMA -->

                                 <div class="shadow overflow-hidden sm:rounded-md">
                                     <div class="px-4 py-5 bg-white sm:p-6">
                                         <div class="grid grid-cols-6 gap-6">
                                             <div class="col-span-6 sm:col-span-3">
                                                 <label for="weapons" class="block text-sm font-medium text-gray-700">Adicionar Arma</label>
                                                 <select enabled id="weapon_id" name="weapon_id" autocomplete="weapon" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                     <option>Selecione</option>
                                                     @foreach($weapons as $weapon)
                                                     <option value="{{$weapon->id}}">{{$weapon->name}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <button type="button" id="showinfoweapon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray" stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                 </svg>
                                             </button>
                                         </div>
                                     </div>

                                     <!-- AJAX PARA MOSTRAR O SELECT COM AS INFORMACOES DA ARMA SELECIONADA -->
                                     <script>
                                         $(document).ready(function() {
                                             $("#showinfoweapon").click(function() {
                                                 const url = "{{ route('load_weapons')}}";
                                                 weaponId = $("#weapon_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'weapon_id': weaponId,
                                                     },
                                                     success: function(data) {
                                                         $("#charinfo").html(data);

                                                     }

                                                 });
                                             });

                                             $("#addweapon").click(function() {
                                                 const url = "{{ route('add_weapon')}}";
                                                 weaponId = $("#weapon_id").val();

                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'weapon_id': weaponId,

                                                     },
                                                     success: function(data) {
                                                         alert("Arma adicionada!");
                                                     }

                                                 });
                                             });

                                         });
                                     </script>

                                     <!-- INFORMAÇÕES SAO MOSTRADAS NESTA DIV -->
                                     <div id="charinfo">

                                     </div>

                                     <!-- BOTAO MOSTRAR MINHAS ARMAS -->
                                     <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse ">
                                         <button type="button" onclick="mostrarModalArmas()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                             Opções de ataque
                                         </button>
                                     </div>

                                     <!-- BOTAO MOSTRAR TODAS ARMAS EM TABELA -->
                                     <div class="inline-flex px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse">
                                         <button type="button" onclick="mostrarModalTodasArmas()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium hover:border-purple-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-300 sm:ml-3 sm:w-auto sm:text-sm">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="purple" stroke-width="1">
                                                 <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                             </svg>
                                         </button>
                                     </div>


                                     <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse">
                                         <button id="addweapon" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                             Adicionar
                                         </button>
                                     </div>

                                     <!-- INICIO MODAL MINHAS ARMAS -->
                                     <div id="modal_weapons" class="fixed z-10 inset-0 overflow-y-auto bg-opacity-75" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                                         <div class="flex items-end justify-center min-h-screen pt-10 px-10 pb-20 text-center sm:block sm:p-0">

                                             <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                             <!-- This element is to trick the browser into centering the modal contents. -->
                                             <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                             <div class="relative inline-block align-bottom bg-white rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                 <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                     <div class="sm:flex sm:items-start">
                                                         <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                             <!-- Heroicon name: outline/exclamation -->
                                                             <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                             </svg>
                                                         </div>
                                                         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-center">
                                                             <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Opções de ataque</h3>
                                                             <div class="mt-2">
                                                                 @if (isset($char))
                                                                 <div class="px-4 py-5 bg-white sm:p-6">
                                                                     <div class="grid grid-cols-6 gap-6">
                                                                         <div class="col-span-6 sm:col-span-6">
                                                                             <select id="myweapon_id" name="myweapon_id" autocomplete="weapon" class="mt-1 block w-full py-2 px-50 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-x">
                                                                                 <option>Selecione</option>
                                                                                 @foreach ($char->weapons as $weapon)
                                                                                 <option value="{{$weapon->id}}">{{$weapon->name}}</option>
                                                                                 @endforeach
                                                                             </select>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 @else
                                                                 <label>Voce ainda nao tem armas... Va a um ferreiro comprar uma!</label>
                                                                 @endif
                                                                 <div id="myweaponinfo">

                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                     <button type="button" id="deletemyweapon" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Excluir</button>
                                                     <button type="button" id="showmyweapon" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-indigo-400 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Visualizar</button>
                                                     <button type="button" onclick="mostrarModalArmas()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Fechar</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <script>
                                         $(document).ready(function() {
                                             $("#showmyweapon").click(function() {
                                                 const url = "{{ route('load_myweapon')}}";
                                                 myWeaponId = $("#myweapon_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'myweapon_id': myWeaponId,
                                                     },
                                                     success: function(data) {
                                                         $("#myweaponinfo").html(data);
                                                     }

                                                 });
                                             });
                                         });

                                         $(document).ready(function() {
                                             $("#deletemyweapon").click(function() {
                                                 const url = "{{ route('delete_myweapon')}}";
                                                 myWeaponId = $("#myweapon_id").val();
                                                 $.ajax({
                                                     url: url,
                                                     data: {
                                                         'myweapon_id': myWeaponId,
                                                     },
                                                     success: function(data) {
                                                         alert("Arma removida com sucesso!");
                                                         location.reload();
                                                     }

                                                 });
                                             });
                                         });
                                     </script>
                                     <!-- Fim Modal -->

                                 </div>


                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!--ESCUDO -->
     <div class="py-12" id="armadura">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                 <div class="p-6 bg-white border-b border-gray-200">
                     <div class="mt-10 sm:mt-0">
                         <div class="md:grid md:grid-cols-3 md:gap-6">
                             <div class="md:col-span-1">
                                 <div class="px-4 sm:px-0">
                                     <h3 class="text-lg font-medium leading-6 text-gray-900">Escudo</h3>
                                     <p class="mt-1 text-sm text-gray-600">
                                         Escudo do personagem
                                     </p>
                                 </div>
                             </div>
                             <div class="mt-5 md:mt-0 md:col-span-2">

                                 <div class="shadow overflow-hidden sm:rounded-md">
                                     <div class="px-4 py-5 bg-white sm:p-6">
                                         <div class="grid grid-cols-6 gap-6">
                                             <div class="col-span-6 sm:col-span-3">
                                                 <label for="shield" class="block text-sm font-medium text-gray-700">Escudo</label>
                                                 <select id="shield_id" name="shield_id" autocomplete="armor" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                     <option value="{{$char->relShields->id ?? ''}}">{{$char->relShields->name ?? 'Selecione'}}</option>
                                                     @foreach($shields as $shield)
                                                     <option value="{{$shield->id}}">{{$shield->name}}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <button type="button" id="showinfoshield">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray" stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                 </svg>
                                             </button>

                                         </div>
                                         <script>
                                             $(document).ready(function() {
                                                 $("#showinfoshield").click(function() {
                                                     const url = "{{ route('load_shields')}}";
                                                     shieldId = $("#shield_id").val();
                                                     $.ajax({
                                                         url: url,
                                                         data: {
                                                             'shield_id': shieldId,
                                                         },
                                                         success: function(data) {
                                                             $("#shieldinfo").html(data);
                                                         }

                                                     });

                                                 });
                                             });
                                         </script>

                                         <div id="shieldinfo">

                                         </div>

                                         <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                             <button type="button" onclick="mostrarModalTodasArmaduras()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                                 Ver Todas
                                             </button>
                                         </div>
                                     </div>

                                 </div>

                             </div>
                         </div>
                     </div>
                     <!-- INICIO MODAL TODAS ARMADURAS -->
                     <div id="modal_AllArmors" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                         <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                             <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>


                             <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                             <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-xl">
                                 <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                     <div class="sm:flex sm:items-start">
                                         <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-200 sm:mx-0 sm:h-10 sm:w-10">
                                             <!-- Icone -->
                                             <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 121.66" style="enable-background:new 0 0 122.88 121.66" xml:space="preserve">
                                                 <style type="text/css">
                                                     .st0 {
                                                         fill-rule: evenodd;
                                                         clip-rule: evenodd;
                                                     }
                                                 </style>
                                                 <path class="st0" d="M7.21,96.55l2.84,2.84l23.32-23.32l-4-4c-3.38-3.38-4.05-8.48-2.01-12.54l7.9,7.9l66.52-66.52 c0.3-0.3,0.71-0.45,1.11-0.42L121.4,0c0.8-0.02,1.46,0.61,1.48,1.41c0,0.03,0,0.06,0,0.09h0l-0.7,18.41 c-0.01,0.38-0.17,0.72-0.42,0.97l0,0L55.24,87.41l7.05,7.05c-4.06,2.04-9.16,1.37-12.54-2.01l-4-4l-23.32,23.32l2.68,2.68 c1.64,1.64,1.64,4.33,0,5.98l0,0c-1.64,1.64-4.33,1.64-5.98,0L1.23,102.52c-1.64-1.64-1.64-4.33,0-5.98h0 C2.88,94.9,5.57,94.9,7.21,96.55L7.21,96.55z M45.22,75.4l60.91-60.91l0,0c0.56-0.56,1.48-0.57,2.05,0 c0.57,0.56,0.57,1.48,0.01,2.05l0,0l0,0L47.27,77.45l6.91,6.91l65.13-65.13l0.62-16.29l-16.49,0.43L38.31,68.49L45.22,75.4 L45.22,75.4z" />
                                             </svg>
                                         </div>
                                         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                             <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                 Armaduras
                                             </h3>
                                             <div class="flex flex-col">
                                                 <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                     <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                         <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                                             <!--tabela com as armaduras -->
                                                             <table class="min-w-full divide-y divide-gray-200">
                                                                 <thead class="bg-gray-50">
                                                                     <tr>
                                                                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                             Nome
                                                                         </th>
                                                                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                             Descricao
                                                                         </th>
                                                                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                             Bonus na CA
                                                                         </th>
                                                                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                             Penalidade
                                                                         </th>
                                                                         <th scope="col" class="relative px-6 py-3">
                                                                             <span class="sr-only">Ver mais</span>
                                                                         </th>
                                                                     </tr>
                                                                 </thead>
                                                                 <tbody class="bg-white divide-y divide-gray-200">
                                                                     @foreach($armors as $armor)
                                                                     <tr>
                                                                         <td class="px-6 py-4 whitespace-nowrap">
                                                                             <div class="flex items-center">
                                                                                 <div class="ml-4">
                                                                                     <div class="text-sm font-medium text-gray-900">
                                                                                         {{$armor->name}}
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </td>
                                                                         <td class="px-6 py-4 whitespace-nowrap">
                                                                             <div class="text-sm text-gray-500">
                                                                                 {{$armor->desc}}
                                                                             </div>
                                                                         </td>
                                                                         <td class="px-6 py-4 whitespace-nowrap">
                                                                             <div class="text-sm text-gray-500">
                                                                                 {{$armor->ca_bonus}}
                                                                             </div>
                                                                         </td>
                                                                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                             {{$armor->penal}}
                                                                         </td>
                                                                         <td class=" px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                             <a href="#" class="text-indigo-600 hover:text-indigo-900">Mais</a>
                                                                         </td>
                                                                     </tr>
                                                                     @endforeach
                                                                 </tbody>
                                                             </table>

                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                     <button onclick="mostrarModalTodasArmaduras()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                         Fechar
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- FIM ESCUDO -->

     <!--MOCHILA DO PERSONAGEM-->
     <div class="py-12" id="mochila">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

                     <div class="mt-10 sm:mt-0">
                         <div class="md:grid md:grid-cols-3 md:gap-6">
                             <div class="md:col-span-1">
                                 <div class="px-4 sm:px-0">
                                     <h3 class="text-lg font-medium leading-6 text-gray-900">Mochila</h3>
                                     <p class="mt-1 text-sm text-gray-600">
                                         Mochila do personagem
                                     </p>
                                 </div>
                             </div>
                             <div class="flex justify-center">
                                 <div class="mb-3 xl:w-96">
                                     <label for="bag" class="form-label inline-block mb-2 text-gray-700">Mochila</label>
                                     <textarea name="bag" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="bag" rows="3">{{$char->bag ?? 'Nada'}}</textarea>
                                 </div>
                             </div>

                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
     <!-- FIM MOCHILA -->
 </div>
 <!-- FIM DIV EQUIPAMENTOS -->