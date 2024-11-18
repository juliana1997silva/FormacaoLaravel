<x-layout title="Controle de Séries">
    <a href="/series/criar" class="btn btn-success mb-5">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item">{{$serie}}</li>
        @endforeach
    </ul>
</x-layout>