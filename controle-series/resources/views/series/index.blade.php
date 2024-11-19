<x-layout title="Controle de Séries">
    <a href="{{route('series.create')}} " class="btn btn-success mb-5">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item">{{$serie->nome}}</li>
        @endforeach
    </ul>
</x-layout>