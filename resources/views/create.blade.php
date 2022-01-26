<head>
    <script src="../../public/js/evento.js"></script>
</head>
<x-app-layout>


    <!--HEADER COM NOME DA PAGINA -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (isset($char)) Editar Personagem @else Novo Personagem @endif
        </h2>
    </x-slot>

    <!--STEPS DA CRIACAO-->
    <div class="flex items-center grid grid-cols-4 text-xs gap-1 w-4/4 m-auto">
        <div class="border-t-4 border-purple-500 pt-1">
            <a style="cursor: pointer;" class="uppercase text-purple-500 font-bold" onclick="mostrarDivInfo()">Informacoes</a>
        </div>
        <div id="steppericia" class="border-t-4 border-gray-200 pt-1">
            <p style="cursor: pointer;" class="uppercase text-gray-400 font-bold" onclick="mostrarDivPericias()">Pericias</p>
        </div>
        <div class="border-t-4 border-gray-200 pt-1">
            <p style="cursor: pointer;" class="uppercase text-gray-400 font-bold" onclick="mostrarDivEquipamentos()">Equipamentos</p>
        </div>
        <div class="border-t-4 border-gray-200 pt-1">
            <p class="uppercase text-gray-400 font-bold">Magias</p>
        </div>
    </div>

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



                                @if (isset ($char))
                                <form name="formEdit" id="formEdit" method="post" action="/chars/{{$char->id}}">
                                    @method('PUT');
                                    @else
                                    <form name="formCad" id="formCad" method="post" action="{{url('chars')}}">
                                        @endif
                                        @csrf
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="name" class="block text-sm font-medium text-gray-700" required>Nome</label>
                                                        <input type="text" name="name" value="{{$char->name ?? ''}}" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="level" class="block text-sm font-medium text-gray-700">Nivel</label>
                                                        <input type="number" name="level" value="{{$char->level ?? ''}}" id="level" autocomplete="level" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>

                                                    @if (isset($char))
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="user_id" class="block text-sm font-medium text-gray-700">ID do Jogador</label>
                                                        <input type="user_id" name="user_id" value="{{$char->user_id}}" id="user_id" autocomplete="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md" readonly>
                                                    </div>
                                                    @else
                                                    <div class="col-span-3 sm:col-span-2">
                                                        <label for="user_id" class="block text-sm font-medium text-gray-700">Jogador</label>
                                                        <select id="user_id" name="user_id" autocomplete="user_id" value="{{$char->relUsers->id ?? Auth::user()}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option readonly value="{{$char->relUsers->id ?? Auth::user()->id}}">{{$char->relUsers->name ?? Auth::user()->name}}</option>
                                                        </select>
                                                    </div>
                                                    @endif


                                                    <div class="col-span-3 sm:col-span-3">
                                                        <label for="breed_id" class="block text-sm font-medium text-gray-700">Raça</label>
                                                        <select id="breed_id" name="breed_id" autocomplete="breed" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="{{$char->relBreeds->id ?? ''}}">{{$char->relBreeds->name ?? 'Selecione'}}</option>
                                                            @foreach($breeds as $breed)
                                                            <option value="{{$breed->id}}">{{$breed->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-span-3 sm:col-span-3">
                                                        <label for="class" class="block text-sm font-medium text-gray-700">Classe</label>
                                                        <select id="class_id" name="class_id" autocomplete="class" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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

                                                    <div class="col-span-3 sm:col-span-6 lg:col-span-2">
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
                                                    <input type="number" value="{{$char->modstr ?? ''}}" id="modstr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="dex" class="block text-sm font-bold text-indigo-700">Destreza</label>
                                                    <input type="number" value="{{$char->dex ?? ''}}" onkeyup="calcularCusto(this)" onblur="valida(this)" name="dex" id="dex" autocomplete="dex" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="moddex" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                    <input type="number" value="{{$char->moddex ?? ''}}" name="moddex" id="moddex" autocomplete="moddex" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="con" class="block text-sm font-bold text-indigo-700">Constituição</label>
                                                    <input type="number" value="{{$char->con ?? ''}}" name="con" id="con" autocomplete="con" onkeyup="calcularCusto( this );" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>
                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="modcon" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                    <input type="number" value="{{$char->modcon ?? ''}}" name="modcon" id="modcon" autocomplete="modcon" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="int" class="block text-sm font-bold text-indigo-500">Inteligência</label>
                                                    <input type="number" value="{{$char->int ?? ''}}" name="int" id="int" autocomplete="int" onkeyup="calcularCusto( this );" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>
                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="modint" class="block text-sm font-medium text-gray-700">Modificador</label>
                                                    <input type="number" value="{{$char->modint ?? ''}}" name="modint" id="modint" autocomplete="modint" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="wiz" class="block text-sm font-bold text-indigo-500">Sabedoria</label>
                                                    <input type="number" value="{{$char->wiz ?? ''}}" name="wiz" id="wiz" autocomplete="wiz" onkeyup="calcularCusto( this );" onblur="valida( this );" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="pv" class="block text-sm font-bold text-gray-700">PV Total</label>
                                                    <input type="number" value="{{$char->pv ?? ''}}" name="pv" id="pv" autocomplete="pv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="actpv" class="block text-sm font-medium text-gray-700">PV Atual</label>
                                                    <input type="number" value="{{$char->actpv ?? ''}}" name="actpv" id="actpv" autocomplete="actpv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="dv" class="block text-sm font-medium text-gray-700">Dado de Vida</label>
                                                    <input type="text" value="{{$char->dv ?? ''}}" name="dv" id="dv" autocomplete="dv" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-2">
                                                    <label for="desloc" class="block text-sm font-medium text-gray-700">Deslocamento</label>
                                                    <input type="number" value="{{$char->desloc ?? ''}}" name="desloc" id="desloc" autocomplete="desloc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <!-- CLASSE DE ARMADURA -->
                                                <script>

                                                </script>


                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="ca" class="block text-sm font-bold text-gray-700">CA</label>
                                                    <input type="number" value="{{$char->ca ?? ''}}" name="ca" id="ca" placeholder="10" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>


                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="bonusarmor" class="block text-sm font-medium text-gray-700">Armadura</label>
                                                    <input type="number" value="{{$char->bonusarmor ?? ''}}" onkeyup="somaCA(this)" name="bonusarmor" id="bonusarmor" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="bonusshield" class="block text-sm font-medium text-gray-700">Escudo</label>
                                                    <input type="number" value="{{$char->bonusshield ?? ''}}" onkeyup="somaCA(this)" name="bonusshield" id="bonusshield" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="moddex2" class="block text-sm font-medium text-gray-700">Destreza</label>
                                                    <input type="number" value="{{$char->moddex ?? ''}}" onkeyup="somaCA(this)" name="moddex2" id="moddex2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </label>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-1">
                                                    <label for="bonusweight" class="block text-sm font-medium text-gray-700">Outro</label>
                                                    <input type="number" value="{{$char->bonusweight ?? ''}}" name="bonusweight" id="bonusweight" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-1">
                                                    <label for="bonussize" class="block text-sm font-medium text-gray-700">Tamanho</label>
                                                    <input type="number" value="{{$char->bonussize ?? ''}}" onkeyup="somaCA(this)" name="bonussize" id="bonussize" autocomplete="bonussize" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                                            <div class="grid grid-cols-6 gap-3">


                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="for" class="block text-sm font-bold text-red-700">Fortitude</label>
                                                    <input type="number" value="{{$char->for ?? ''}}" name="for" id="for" autocomplete="for" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-red-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="basefor" class="block text-sm font-medium text-red-700">Base</label>
                                                    <input type="number" value="{{$char->basefor ?? ''}}" id="basefor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="habfor" class="block text-sm font-medium text-red-700">Habilidade</label>
                                                    <input type="number" value="{{$char->habfor ?? ''}}" id="habfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="magicfor" class="block text-sm font-medium text-red-700">Magico</label>
                                                    <input type="number" value="{{$char->magicfor ?? ''}}" id="magicfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="otherfor" class="block text-sm font-medium text-red-700">Outro</label>
                                                    <input type="number" value="{{$char->otherfor ?? ''}}" id="otherfor" onkeyup="calcularResistenciaFor(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></label>
                                                </div>
                                                </br>


                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="ref" class="block text-sm font-bold text-gray-700">Reflexos</label>
                                                    <input type="number" value="{{$char->ref ?? ''}}" name="ref" id="ref" autocomplete="ref" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="baseref" class="block text-sm font-medium text-gray-700">Base</label>
                                                    <input type="number" value="{{$char->baseref ?? ''}}" id="baseref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="habref" class="block text-sm font-medium text-gray-700">Habilidade</label>
                                                    <input type="number" value="{{$char->habref ?? ''}}" id="habref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="magicref" class="block text-sm font-medium text-gray-700">Magico</label>
                                                    <input type="number" value="{{$char->magicref ?? ''}}" id="magicref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="otherref" class="block text-sm font-medium text-gray-700">Outro</label>
                                                    <input type="number" value="{{$char->otherref ?? ''}}" id="otherref" onkeyup="calcularResistenciaRef(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>
                                                </br>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="will" class="block text-sm font-bold text-blue-700">Vontade</label>
                                                    <input type="number" value="{{$char->will ?? ''}}" name="will" id="will" autocomplete="will" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-blue-300 rounded-md">
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="basewill" class="block text-sm font-medium text-blue-700">Base</label>
                                                    <input type="number" value="{{$char->basewill ?? ''}}" id="basewill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></label>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="habwill" class="block text-sm font-medium text-blue-700">Habilidade</label>
                                                    <input type="number" value="{{$char->habwill ?? ''}}" id="habwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="magicwill" class="block text-sm font-medium text-blue-700">Magico</label>
                                                    <input type="number" value="{{$char->magicwill ?? ''}}" id="magicwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="otherwill" class="block text-sm font-medium text-blue-700">Outro</label>
                                                    <input type="number" value="{{$char->otherwill ?? ''}}" id="otherwill" onkeyup="calcularResistenciaWill(this)" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></input>
                                                </div>
                                                </br>

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
                                        <button onclick="mostrarDivPericias()" class=" mx-3 bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
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
    </div>

    <!--PERICIAS-->
    <div id="pericias" class="pericias" style="display: none;">
        <div class="py-12" id="info">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                                        Pericia
                                                    </th>
                                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Hab. Chave
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Total
                                                    </th>
                                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Mod Habilidade
                                                    </th>
                                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Graduacao
                                                    </th>
                                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Outros
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Acrobacia
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES*`
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Adestrar Animais
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    Abrir Fechaduras
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            DES
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <input type="number" value="" name="totalhab" id="totalhab" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <input type="number" value="" name="modhability" onkeyup="somaPericia(this)" id="modhability" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="graduation" onkeyup="somaPericia(this)" id="graduation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <input type="number" value="" name="otherexpertise" onkeyup="somaPericia(this)" id="otherexpertise" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </td>
                                                </tr>




                                            </tbody>
                                        </table>


                                        <div class="mt-8 p-4">
                                            <div class="flex p-2 mt-4">
                                                <button onclick="mostrarDivInfo()" class="bg-gray-200 text-gray-800 active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                                                    Voltar
                                                </button>
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
                </div>
            </div>
        </div>
    </div>

    <!--EQUIPAMENTOS-->

    <div id="equipamentos" class="equipamentos" style="display: none;">
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

                                                        @foreach($armors as $armor)
                                                        <option value="{{$armor->id}}">{{$armor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

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
                                                    <label for="weapons" class="block text-sm font-medium text-gray-700">Armas</label>
                                                    <select id="weapon_id" name="weapon_id" autocomplete="weapon" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                        <option>Selecione</option>
                                                        @foreach($weapons as $weapon)
                                                        <option value="{{$weapon->id}}">{{$weapon->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse ">
                                            <button type="button" onclick="mostrarModalArmas()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Minhas Armas
                                            </button>
                                        </div>

                                        <div class="inline-flex bg-gray-50 px-4 py-3 sm:px-2 sm:flex-auto sm:flex-row-reverse">
                                            <button type="button" onclick="mostrarModalTodasArmas()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300 sm:ml-3 sm:w-auto sm:text-sm">
                                                Ver Todas
                                            </button>
                                        </div>

                                        <!-- INICIO MODAL MINHAS ARMAS -->
                                        <div id="modal_weapons" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
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
                                                                    Minhas armas
                                                                </h3>
                                                                <div class="flex flex-col">
                                                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                                                @if (isset($char))
                                                                                <!--tabela com as armas -->
                                                                                <table class="min-w-full divide-y divide-gray-200">
                                                                                    <thead class="bg-gray-50">
                                                                                        <tr>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Nome
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Dano
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Decisivo
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Bonus
                                                                                            </th>
                                                                                            <th scope="col" class="relative px-6 py-3">
                                                                                                <span class="sr-only">Ver mais</span>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                                                        @foreach($char->weapons as $weapon)
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="flex items-center">
                                                                                                    <div class="ml-4">
                                                                                                        <div class="text-sm font-medium text-gray-900">
                                                                                                            {{$weapon->name}}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="text-sm text-gray-500">
                                                                                                    {{$weapon->damage}}
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="text-sm text-gray-500">
                                                                                                    {{$weapon->decisive}}
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                                                {{$weapon->total_bba}}
                                                                                            </td>
                                                                                            <td class=" px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                                @else
                                                                                <label>Voce ainda nao tem armas... Va a um ferreiro comprar uma!</label>
                                                                                @endif

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <button onclick="mostrarModalArmas()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            Fechar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim Modal -->

                                        <!-- INICIO MODAL TODAS ARMAS -->
                                        <div id="modal_AllWeapons" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
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
                                                                    Arsenal
                                                                </h3>
                                                                <div class="flex flex-col">
                                                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                                                                <!--tabela com as armas -->
                                                                                <table class="min-w-full divide-y divide-gray-200">
                                                                                    <thead class="bg-gray-50">
                                                                                        <tr>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Nome
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Dano
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Decisivo
                                                                                            </th>
                                                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                                                Bonus
                                                                                            </th>
                                                                                            <th scope="col" class="relative px-6 py-3">
                                                                                                <span class="sr-only">Ver mais</span>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                                                        @foreach($weapons as $weapon)
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="flex items-center">
                                                                                                    <div class="ml-4">
                                                                                                        <div class="text-sm font-medium text-gray-900">
                                                                                                            {{$weapon->name}}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="text-sm text-gray-500">
                                                                                                    {{$weapon->damage}}
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                                <div class="text-sm text-gray-500">
                                                                                                    {{$weapon->decisive}}
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                                                {{$weapon->total_bba}}
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
                                                        <button onclick="mostrarModalTodasArmas()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            Fechar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <label for="armor" class="block text-sm font-medium text-gray-700">Escudo</label>
                                                    <select id="armor_id" name="armor_id" autocomplete="armor" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                                        @foreach($armors as $armor)
                                                        <option value="{{$armor->id}}">{{$armor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

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
                                <div class="mt-5 md:mt-0 md:col-span-2">

                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <textarea value="{{$char->bag ?? ''}} widht=" 100%"" cols="20" rows="5" class="resize border rounded-md" style="background-image: url(' http://i.stack.imgur.com/yWNH7.png'); font-size:18px;"></textarea>


                                            </div>
                                        </div>

                                    </div>


                                    @if ((empty ($char)) || (auth()->user()->id == $char->user_id))
                                    <div class="flex-auto flex flex-row-reverse">
                                        <input type="submit" cursor="pointer" value="Salvar" class=" mx-3 bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">

                                        </input>
                                    </div>
                                    @else

                                    <div class="flex-auto flex flex-row-reverse">
                                        <h4 class="font-semibold text-lg text-gray-800 leading-tight">
                                            Somente Visualizacao.
                                        </h4>
                                    </div>
                                    @endif


                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <button onclick="mostrarDivInfo()">Info</button>
    <button onclick="mostrarDivPericias()">Pericias</button>
    <button onclick="mostrarDivEquipamentos()">Equipamentos</button>


    <script src="https://kit.fontawesome.com/07afc061fe.js" crossorigin="anonymous"></script>


    <div id="mega-button">
        <div class="tooltip"></div>
        <a class="sub-button" id="buttons--write" cursor="pointer" onclick="mostrarDivInfo()"></a>
        <a class="sub-button" id="buttons--archive" href="#modal-archive"></a>
        <a class="sub-button" id="buttons--delete" href="#modal-delete"></a>
    </div>


</x-app-layout>