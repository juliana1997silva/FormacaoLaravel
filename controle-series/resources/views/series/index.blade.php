<x-layout title="Controle de Séries">
    <a href="/series/criar">Adicionar</a>

    <ul>
        @foreach ($series as $serie)
        <li>{{$serie}}</li>
        @endforeach
    </ul>
</x-layout>