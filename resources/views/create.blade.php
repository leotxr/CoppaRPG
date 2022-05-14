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
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seu personagem será Criado!</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Você será redirecionado para continuar a criação...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">Continuar</button>
                            <button type="button" onclick=openconfirmcreate() class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
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
                            <input readonly id="char_id" type="number" value="{{$char->id ?? ''}}" class="hidden text-sm w-6 font-bold leading-1 text-gray-900 sm:text-sm sm:truncate"></input>
                            <input id="nameHead" value="{{$char->name ?? ''}}" class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly></input>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6 ">
                                <div class="mt-2 flex items-center text-sm text-gray-500 ">
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
                                <button id="delchar" href="{{route('destroy')}}" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                                        const url = "{{ route('destroy')}}";

                                        $.ajax({
                                            url: url,
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
                                                        <input required onkeyup="TxtOnHead()" type="text" name="name" value="{{$char->name ?? ''}}" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-1">
                                                        <label for="level" class="block text-sm font-medium text-gray-700">Nivel</label>
                                                        <select onmouseup="calcAttrClasses(), calcularResistencia()" name="level" id="level" autocomplete="level" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->level ?? ''}}">{{$char->level ?? 'Selecione'}}</option>
                                                            @for($i=1; $i<=20; $i++) @php $value=$i; @endphp <option value="{{$i}}">{{$i}}</option>
                                                                @endfor

                                                        </select>
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

                                                    <div class="col-span-5 sm:col-span-3">
                                                        <label for="class" class="block text-sm font-medium text-gray-700">Tendencia</label>
                                                        <select name="trend" id="trend" autocomplete="trend" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->trend ?? ''}}">{{$char->trend ?? 'Selecione'}}</option>
                                                            <option value="Leal/Bom">Leal/Bom</option>
                                                            <option value="Leal/Mau">Leal/Mau</option>
                                                            <option value="Leal/Neutro">Leal/Neutro</option>
                                                            <option value="Neutro/Neutro">Neutro/Neutro</option>
                                                            <option value="Caotico/Bom">Caotico/Bom</option>
                                                            <option value="Caotico/Mau">Caotico/Mau</option>
                                                            <option value="Caotico/Neutro">Caotico/Neutro</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-span-5 sm:col-span-6 lg:col-span-3">
                                                        <label for="religion" class="block text-sm font-medium text-gray-700">Divindade</label>
                                                        <input type="text" value="{{$char->religion ?? ''}}" name="religion" id="religion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-5 sm:col-span-3">
                                                        <label for="class" class="block text-sm font-medium text-gray-700">Sexo</label>
                                                        <select name="sex" id="sex" autocomplete="sex" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->sex ?? ''}}">{{$char->sex ?? 'Selecione'}}</option>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Feminino">Feminino</option>
                                                            <option value="Nenhum">Nenhum</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="age" class="block text-sm font-medium text-gray-700">Idade</label>
                                                        <input type="number" value="{{$char->age ?? ''}}" name="age" id="age" autocomplete="age" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                                        <label for="weight" class="block text-sm font-medium text-gray-700">Peso</label>
                                                        <input type="number" value="{{$char->weight ?? ''}}" name="weight" id="weight" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>


                                                    <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                                        <label for="height" class="block text-sm font-medium text-gray-700">Altura(cm)</label>
                                                        <input type="number" value="{{$char->height ?? ''}}" name="height" id="height" autocomplete="height" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-5 sm:col-span-3">
                                                        <label for="class" class="block text-sm font-medium text-gray-700">Tamanho</label>
                                                        <select name="size" id="size" autocomplete="size" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->size ?? ''}}">{{$char->size ?? 'Selecione'}}</option>
                                                            <option value="Pequeno">Pequeno</option>
                                                            <option value="Medio">Medio</option>
                                                            <option value="Grande">Grande</option>
                                                            <option value="Enorme">Enorme</option>
                                                        </select>
                                                    </div>


                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
                                                        <label for="eyes" class="block text-sm font-medium text-gray-700">Cor dos Olhos</label>
                                                        <input type="text" value="{{$char->eyes ?? ''}}" name="eyes" id="eyes" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
                                                        <label for="hair" class="block text-sm font-medium text-gray-700">Cor dos Cabelos</label>
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
        </form>
        @else

        <script>
            window.location.href = "{{ url('dashboard')}}"
        </script>
        @endif
        </div>


</x-app-layout>