<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centro de criação') }}
        </h2>
    </x-slot>

    <form name="charweapon" id="charweapon" method="post" action="" data-weapons-url="{{ route('load_weapons')}}">
        <div id="idDiv">
            <div class="col-span-3 sm:col-span-2">
                <label for="char_id" class="block text-sm font-medium text-gray-700">Personagens</label>
                <select id="char_id" name="char_id" autocomplete="char_id" value="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Selecione</option>
                    @foreach ($chars as $char)
                    <option value="{{$char->id}}">{{$char->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="idDiv2">
            <div class="col-span-3 sm:col-span-2">
                <label for="weapon_id" class="block text-sm font-medium text-gray-700">Personagens</label>
                <select id="weapon_id" name="weapon_id" autocomplete="weapon_id" value="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Selecione</option>
                    @foreach ($weapons as $weapon)
                    <option value="{{$weapon->id}}">{{$weapon->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Raca e Classe
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vida atual
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acoes
                    </th>
                </tr>
            </thead>
            <tbody id="charinfo" class="bg-white divide-y divide-gray-200">
                
            </tbody>
        </table>
    </form>

    <script>
        $(document).ready(function() {
            $("#char_id").change(function() {
                const url = $('#charweapon').attr("data-weapons-url");
                charId = $(this).val();
                $.ajax({
                    url: url,
                    data: {
                        'char_id': charId,
                    },
                    success: function(data) {
                        $("#weapon_id").html(data);
                        alert(charId);
                    }

                });

            });
        });
    </script>



</x-app-layout>