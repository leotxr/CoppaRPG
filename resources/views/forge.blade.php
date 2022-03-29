<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centro de criação') }}
        </h2>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<form method="POST" action="recebe.php?valida=TRUE">
<input type="button" id="add_div" value="adicionar"> <input type="submit" value="Enviar"/>
<br>
<div id="idDiv">
    <div>
    Cód. Produto: <input type="text" name="codProduto[]"/>
    Quantidade: <input type="text" name="qtdProduto[]"/>
     
    </div>
</div>
</form>

</x-app-layout>