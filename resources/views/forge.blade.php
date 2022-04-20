<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centro de criação') }}
        </h2>
    </x-slot>
    
<form name="formteste" id="formteste" method="post" action="" 
teste="{{url('load_funcoes')}}">
    <div id="idDiv">
        <div class="col-span-3 sm:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Jogador</label>
            <select id="user_id" name="user_id" autocomplete="user_id" value="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Selecione</option>
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
            </select>
        </div>
    </div>

    <div id="idDiv2">
        <div class="col-span-3 sm:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Personagem</label>
            <select id="char_id" name="char_id" autocomplete="char_id" value="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Selecione</option>
                @foreach ($chars as $char)
                <option value="{{$char->id}}">{{$char->name}}</option>
                    @endforeach
            </select>
        </div>
    </div>
<div id="tabela">

</div>
    </form>


<script> 

$(document).ready(function(){
    $("#user_id").change(function(){
        var url = $('#formteste').attr("teste");
        userId = $(this).val();
        $.ajax({
            url : url,
            data: {
                'user_id':userId,
            },
            success: function(data){
                $("#tabela").html(data);
            }

        });
        
    });
});


</script>

</x-app-layout>