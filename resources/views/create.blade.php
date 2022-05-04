<head>
    <script src="../../public/js/evento.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
</head>

<x-app-layout>

    @if (isset ($char))
    <form name="formEdit" id="formEdit" method="post" action="/chars/{{$char->id}}" data-weapons-url="{{ route('load_weapons')}}">
        @method('PUT')
        @else
        <form name="formCad" id="formCad" method="post" action="{{url('chars')}}" data-weapons-url="{{ route('load_weapons')}}">
            @endif
            @csrf

            <!-- Modal confirmacao de criacao -->
            <div id="confirmcreate" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">

                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seu personagem foi Criado!</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Certifique-se de que todas as informações estão corretas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">Finalizar</button>
                            <button type="button" onclick=openconfirmcreate() class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fim-->

            <!--HEADER COM NOME DA PAGINA -->
            <x-slot name="header" style="position: absolute;">
                @if ((empty ($char)) || (auth()->user()->id == $char->user_id))
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="flex-1 min-w-0">
                            <input id="nameHead" value="{{$char->name ?? ''}}" class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate" readonly></input>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: solid/beaker -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                    {{$char->relClasses->name ?? ''}}
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: solid/finger-print -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                    </svg>
                                    {{$char->relBreeds->name ?? ''}}
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: solid/currency-dollar -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>

                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: solid/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex lg:mt-0 lg:ml-4">
                            <span class="hidden sm:block">
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <!-- Heroicon name: solid/pencil -->
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Editar
                                </button>
                            </span>

                            <span class="hidden sm:block ml-3">
                                <button id="delchar" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <!-- Heroicon name: solid/link -->
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                    </svg>
                                    Apagar
                                </button>
                            </span>
                            <script>
                                $(document).ready(function() {
                                    $("#delchar").click(function() {
                                        const url = "{{ route('delete_char')}}";
                                        charId = $char_id;
                                        $.ajax({
                                            url: url,
                                            data: {
                                                'charId': charId,
                                            },
                                            success: function(data) {
                                                alert("Personagem removido com sucesso!");

                                            }

                                        });
                                    });
                                });
                            </script>

                            <span class="sm:ml-3">
                                <button type="submit" id="btn_save" onclick=openconfirmcreate() class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <!-- Heroicon name: solid/check -->
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Salvar
                                </button>
                            </span>

                            <!-- Dropdown -->
                            <span class="ml-3 relative sm:hidden">
                                <button id="btn_dropdown" onclick=dropdownhead() type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="mobile-menu-button" aria-expanded="false" aria-haspopup="true">
                                    More
                                    <!-- Heroicon name: solid/chevron-down -->
                                    <svg class="-mr-1 ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="divdropdown" style="display: none" class="origin-top-right absolute right-0 mt-2 -mr-1 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button" tabindex="-1">
                                    <!-- Active: "bg-gray-100", Not Active: "" -->
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="mobile-menu-item-0">Editar</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="mobile-menu-item-1">Ver</a>
                                </div>
                            </span>
                        </div>
                    </div>

                </h2>

            </x-slot>



            <!--STEPS DA CRIACAO-->

            <!-- INFORMACOES INICIAIS DO PERSONAGEM-->
            <div class="py-12" id="info">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">

                            <div class="hidden sm:block" aria-hidden="true">
                                <div class="py-5">
                                    <div class="border-t border-gray-200"></div>
                                </div>
                            </div>

                            <div class="mt-10 sm:mt-0">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="md:col-span-1">
                                        <div class="px-4 sm:px-0">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Informações básicas</h3>
                                            <p class="mt-1 text-sm text-gray-600">
                                                Aqui ficam as informações básicas do seu personagem.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-5 md:mt-0 md:col-span-2">




                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="name" class="block text-sm font-medium text-gray-700" required>Nome</label>
                                                        <input onkeyup="TxtOnHead()" type="text" name="name" value="{{$char->name ?? ''}}" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="level" class="block text-sm font-medium text-gray-700">Nivel</label>
                                                        <input type="number" onmouseup="calcAttrClasses(), calcularResistencia()" name="level" value="{{$char->level ?? ''}}" id="level" autocomplete="level" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>


                                                    @if (isset($char))
                                                    <div class="col-span-2 sm:col-span-1" style="display: none;">
                                                        <label for="user_id" class="block text-sm font-medium text-gray-700">ID do Jogador</label>
                                                        <input type="user_id" name="user_id" value="{{$char->user_id}}" id="user_id" autocomplete="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md" readonly>
                                                    </div>
                                                    @else
                                                    <div class="col-span-3 sm:col-span-2" style="display: none;">
                                                        <label for="user_id" class="block text-sm font-medium text-gray-700">Jogador</label>
                                                        <select id="user_id" name="user_id" autocomplete="user_id" value="{{$char->relUsers->id ?? Auth::user()}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option readonly value="{{$char->relUsers->id ?? Auth::user()->id}}">{{$char->relUsers->name ?? Auth::user()->name}}</option>
                                                        </select>
                                                    </div>
                                                    @endif


                                                    <div class="col-span-3 sm:col-span-2">
                                                        <input type="button" class="block text-lg font-medium text-purple-600">Biografia</input>
                                                    </div>

                                                    <div class="col-span-5 sm:col-span-4">
                                                        <label for="breed_id" class="block text-sm font-medium text-gray-700">Raça</label>
                                                        <select id="breed_id" name="breed_id" autocomplete="breed" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->relBreeds->id ?? ''}}">{{$char->relBreeds->name ?? 'Selecione'}}</option>
                                                            @foreach($breeds as $breed)
                                                            <option value="{{$breed->id}}">{{$breed->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                    <div class="col-span-5 sm:col-span-4">
                                                        <label for="class" class="block text-sm font-medium text-gray-700">Classe</label>
                                                        <select onmouseup="calcAttrClasses(), calcularResistencia()" name="class_id" id="class_id" autocomplete="class" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->relClasses->id ?? ''}}">{{$char->relClasses->name ?? 'Selecione'}}</option>
                                                            @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-3">
                                                        <label for="trend" disabled class="block text-sm font-medium text-gray-700">Tendência</label>
                                                        <input type="text" value="{{$char->trend ?? ''}}" name="trend" id="trend" autocomplete="trend" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-3">
                                                        <label for="religion" class="block text-sm font-medium text-gray-700">Divindade</label>
                                                        <input type="text" value="{{$char->religion ?? ''}}" name="religion" id="religion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="age" class="block text-sm font-medium text-gray-700">Idade</label>
                                                        <input type="number" value="{{$char->age ?? ''}}" name="age" id="age" autocomplete="age" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
                                                        <label for="sex" class="block text-sm font-medium text-gray-700">Sexo</label>
                                                        <input type="text" value="{{$char->sex ?? ''}}" name="sex" id="sex" autocomplete="sex" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                                        <label for="weight" class="block text-sm font-medium text-gray-700">Peso</label>
                                                        <input type="number" value="{{$char->weight ?? ''}}" name="weight" id="weight" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>


                                                    <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                                        <label for="height" class="block text-sm font-medium text-gray-700">Altura(cm)</label>
                                                        <input type="number" value="{{$char->height ?? ''}}" name="height" id="height" autocomplete="height" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-3 lg:col-span-2">
                                                        <label for="size" class="block text-sm font-medium text-gray-700">Tamanho</label>
                                                        <input type="text" value="{{$char->size ?? ''}}" name="size" id="size" autocomplete="size" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>


                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
                                                        <label for="eyes" class="block text-sm font-medium text-gray-700">Olhos</label>
                                                        <input type="text" value="{{$char->eyes ?? ''}}" name="eyes" id="eyes" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
                                                        <label for="hair" class="block text-sm font-medium text-gray-700">Cabelos</label>
                                                        <input type="text" value="{{$char->hair ?? ''}}" name="hair" id="hair" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- PONTOS DE HABILIDADE -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <div class="hidden sm:block" aria-hidden="true">
                                    <div class="py-5">
                                        <div class="border-t border-gray-200"></div>
                                    </div>
                                </div>
                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Pontos de Habilidade</h3>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    Cada habilidade descreve um aspecto do seu personagem e afeta determinadas ações.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">

                                            <!--FORM-->
                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="grid grid-cols-6 gap-6">


                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="str" class="block text-sm font-bold text-indigo-700">Força</label>
                                                            <input type="number" value="{{$char->str ?? ''}}" onkeyup="calcularCusto(this)" onblur="valida(this)" name="str" id="str" autocomplete="str" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="modstr" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->modstr ?? ''}}" id="modstr" name="modstr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>
                                                        </br>

                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="dex" class="block text-sm font-bold text-indigo-700">Destreza</label>
                                                            <input type="number" value="{{$char->dex ?? ''}}" onkeyup="calcularCusto(this), calcularResistencia(this)" , onblur="valida(this), somaCA()" name="dex" id="dex" autocomplete="dex" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>

                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="moddex" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->moddex ?? ''}}" name="moddex" id="moddex" autocomplete="moddex" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>

                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="con" class="block text-sm font-bold text-indigo-700">Constituição</label>
                                                            <input type="number" value="{{$char->con ?? ''}}" name="con" id="con" autocomplete="con" onkeyup="calcularCusto( this ), calcularResistencia(this)" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="modcon" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->modcon ?? ''}}" name="modcon" id="modcon" autocomplete="modcon" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>

                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="int" class="block text-sm font-bold text-indigo-500">Inteligência</label>
                                                            <input type="number" value="{{$char->int ?? ''}}" name="int" id="int" autocomplete="int" onkeyup="calcularCusto( this )" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="modint" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->modint ?? ''}}" name="modint" id="modint" autocomplete="modint" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>

                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="wiz" class="block text-sm font-bold text-indigo-500">Sabedoria</label>
                                                            <input type="number" value="{{$char->wiz ?? ''}}" name="wiz" id="wiz" autocomplete="wiz" onkeyup="calcularCusto( this ), calcularResistencia(this)" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="modwiz" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->modwiz ?? ''}}" name="modwiz" id="modwiz" autocomplete="modwiz" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label for="cha" class="block text-sm font-bold text-indigo-500">Carisma</label>
                                                            <input type="number" value="{{$char->cha ?? ''}}" name="cha" id="cha" autocomplete="cha" onkeyup="calcularCusto( this );" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <label class="block text-sm font-medium text-gray-700">Modificador</label>
                                                            <input type="number" value="{{$char->modcha ?? ''}}" name="modcha" id="modcha" autocomplete="modcha" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        </br>


                                                    </div>
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!--HABILIDADES-->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="hidden sm:block" aria-hidden="true">
                                    <div class="py-5">
                                        <div class="border-t border-gray-200"></div>
                                    </div>
                                </div>
                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Pontos de Vida e Classe de Armadura </h3>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    Informacoes sobre pontos de vida e CA do personagem.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">


                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="grid grid-cols-6 gap-6">

                                                        <div class="col-span-3 sm:col-span-1">
                                                            <label for="actpv" class="block text-sm font-bold text-gray-700">PV Atual</label>
                                                            <input type="number" value="{{$char->actpv ?? ''}}" name="actpv" id="actpv" autocomplete="actpv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-3 sm:col-span-1">
                                                            <label for="pv" class="block text-sm font-medium text-gray-700">PV Total</label>
                                                            <input type="number" value="{{$char->pv ?? ''}}" name="pv" id="pv" autocomplete="pv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-3 sm:col-span-2">
                                                            <label for="dv" class="block text-sm font-medium text-gray-700">Dado de Vida</label>
                                                            <input type="text" value="{{$char->dv ?? ''}}" name="dv" id="dv" autocomplete="dv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-3 sm:col-span-2">
                                                            <label for="desloc" class="block text-sm font-medium text-gray-700">Deslocamento</label>
                                                            <input type="number" value="{{$char->desloc ?? ''}}" name="desloc" id="desloc" autocomplete="desloc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <!-- CLASSE DE ARMADURA -->


                                                        <div class="col-span-2 sm:col-span-2 inline-block">
                                                            <label for="ca" class="block text-sm font-bold text-gray-700">CA</label>
                                                            <input type="number" value="{{$char->ca ?? ''}}" name="ca" id="ca" placeholder="10" class="inline-block mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div>
                                                            <button type="button" id="btn_show_mod" onclick="showdivmods()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div id="div_mods" class="col-span-2 sm:col-span-2 inline-block" style="display: none;">

                                                            <div class="col-span-2 sm:col-span-1 ">
                                                                <label for="bonusarmor" class="block text-sm font-medium text-gray-700">Armadura</label>
                                                                <input type="number" value="{{$char->bonusarmor ?? '0'}}" onkeyup="somaCA(this)" name="bonusarmor" id="bonusarmor" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            </div>

                                                            <div class="col-span-2 sm:col-span-1 ">
                                                                <label for="bonusshield" class="block text-sm font-medium text-gray-700">Escudo</label>
                                                                <input type="number" value="{{$char->bonusshield ?? '0'}}" onkeyup="somaCA(this)" name="bonusshield" id="bonusshield" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            </div>

                                                            <div class="col-span-2 sm:col-span-1 ">
                                                                <label for="moddex2" class="block text-sm font-medium text-gray-700">Mod. Destreza</label>
                                                                <input type="number" value="{{$char->moddex ?? '0'}}" onkeyup="somaCA(this)" name="moddex2" id="moddex2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                                </label>
                                                            </div>

                                                            <div class="col-span-2 sm:col-span-1 ">
                                                                <label for="bonusweight" class="block text-sm font-medium text-gray-700">Outro</label>
                                                                <input type="number" value="{{$char->bonusweight ?? '0'}}" name="bonusweight" id="bonusweight" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            </div>

                                                            <div class="col-span-2 sm:col-span-1 ">
                                                                <label for="bonussize" class="block text-sm font-medium text-gray-700">Mod. Tamanho</label>
                                                                <input type="number" value="{{$char->bonussize ?? '0'}}" onkeyup="somaCA(this)" name="bonussize" id="bonussize" autocomplete="bonussize" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <div class="hidden sm:block" aria-hidden="true">
                                    <div class="py-5">
                                        <div class="border-t border-gray-200"></div>
                                    </div>
                                </div>
                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Testes de Resistencia</h3>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    Testes de resistencia
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">

                                            <!--FORM-->
                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="grid grid-cols-6 gap-4">


                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="for" class="block text-sm font-bold text-red-700">Fortitude</label>
                                                            <input type="number" value="{{$char->for ?? '0'}}" name="for" id="for" autocomplete="for" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-red-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="basefor" class="block text-sm font-medium text-red-700">Base</label>
                                                            <input type="number" value="{{$char->basefor ?? '0'}}" name="basefor" id="basefor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="habfor" class="block text-sm font-medium text-red-700">Habilidade</label>
                                                            <input type="number" value="{{$char->habfor ?? '0'}}" name="habfor" id="habfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>


                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="magicfor" class="block text-sm font-medium text-red-700">Magico</label>
                                                            <input type="number" value="{{$char->magicfor ?? '0'}}" name="magicfor" id="magicfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="otherfor" class="block text-sm font-medium text-red-700">Outro</label>
                                                            <input type="number" value="{{$char->otherfor ?? '0'}}" name="otherfor" id="otherfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></label>
                                                        </div>




                                                        <p>
                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="ref" class="block text-sm font-bold text-gray-700">Reflexos</label>
                                                            <input type="number" value="{{$char->ref ?? '0'}}" name="ref" id="ref" autocomplete="ref" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="baseref" class="block text-sm font-medium text-gray-700">Base</label>
                                                            <input type="number" value="{{$char->baseref ?? '0'}}" name="baseref" id="baseref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="habref" class="block text-sm font-medium text-gray-700">Habilidade</label>
                                                            <input type="number" value="{{$char->habref ?? '0'}}" name="habref" id="habref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="magicref" class="block text-sm font-medium text-gray-700">Magico</label>
                                                            <input type="number" value="{{$char->magicref ?? '0'}}" name="magicref" id="magicref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="otherref" class="block text-sm font-medium text-gray-700">Outro</label>
                                                            <input type="number" value="{{$char->otherref ?? '0'}}" name="otherref" id="otherref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>
                                                        </p>


                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="will" class="block text-sm font-bold text-blue-700">Vontade</label>
                                                            <input type="number" value="{{$char->will ?? '0'}}" name="will" id="will" autocomplete="will" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-blue-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="basewill" class="block text-sm font-medium text-blue-700">Base</label>
                                                            <input type="number" value="{{$char->basewill ?? '0'}}" name="basewill" id="basewill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></label>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="habwill" class="block text-sm font-medium text-blue-700">Habilidade</label>
                                                            <input type="number" value="{{$char->habwill ?? '0'}}" name="habwill" id="habwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="magicwill" class="block text-sm font-medium text-blue-700">Magico</label>
                                                            <input type="number" value="{{$char->magicwill ?? '0'}}" name="magicwill" id="magicwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="otherwill" class="block text-sm font-medium text-blue-700">Outro</label>
                                                            <input type="number" value="{{$char->otherwill ?? '0'}}" name="otherwill" id="otherwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 p-4">
                                    <div class="flex p-2 mt-4">
                                        <a href="{{url('/chars')}}">
                                            <button class="bg-gray-200 text-gray-800 active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                                                Cancelar
                                            </button>
                                        </a>
                                        <div class="flex-auto flex flex-row-reverse">
                                            <button onclick="mostrarDivEquipamentos()" class=" mx-3 bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                                                Continuar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tela_pericias">
                                <input type="number" name="expertise_id" id="expertise_id" value=""></input>
                <div id="table_pericias">

                </div>
            </div>
            <




            <!--EQUIPAMENTOS-->

            <div id="equipamentos" class="equipamentos" style="display: none">
                <!--ARMADURAS-->
                <div class="py-12" id="armadura">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <!--ARMADURA -->
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Armadura</h3>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    Armadura do personagem
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">

                                            <div class="shadow overflow-hidden sm:rounded-md">
                                                <div class="px-4 py-5 bg-white sm:p-6">
                                                    <div class="grid grid-cols-6 gap-6">
                                                        <div class="col-span-6 sm:col-span-3">
                                                            <label for="armor" class="block text-sm font-medium text-gray-700">Armadura</label>
                                                            <select id="armor_id" name="armor_id" autocomplete="armor" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="{{$char->relArmors->id ?? ''}}">{{$char->relArmors->name ?? 'Selecione'}}</option>
                                                                @foreach($armors as $armor)
                                                                <option value="{{$armor->id}}">{{$armor->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <button type="button" id="showinfoarmor">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </button>

                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $("#showinfoarmor").click(function() {
                                                                const url = "{{ route('load_armors')}}";
                                                                armorId = $("#armor_id").val();
                                                                $.ajax({
                                                                    url: url,
                                                                    data: {
                                                                        'armor_id': armorId,
                                                                    },
                                                                    success: function(data) {
                                                                        $("#armorinfo").html(data);
                                                                    }

                                                                });

                                                            });
                                                        });
                                                    </script>

                                                    <div id="armorinfo">

                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <button type="button" id="vertodas" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 sm:ml-3 sm:w-auto sm:text-sm">
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
                                                        Minhas Armas
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
                                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Suas armas</h3>
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
                                <div class="mt-8 p-4">
                                    <div class="flex p-2 mt-4">
                                        <button onclick="mostrarDivInfo()" class="bg-gray-200 text-gray-800 active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                                            Voltar
                                        </button>

                                        <div class="flex-auto flex flex-row-reverse">
                                            <span class="sm:ml-3">
                                                <button type="button" id="btn_save" onclick=openconfirmcreate() class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <!-- Heroicon name: solid/check -->
                                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    Salvar
                                                </button>
                                            </span>
                                        </div>
                                        @else

                                        <script>
                                            window.location.href = "{{ url('dashboard')}}"
                                        </script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        </div>


</x-app-layout>