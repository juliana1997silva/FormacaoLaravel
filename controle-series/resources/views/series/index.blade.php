<x-layout title="Controle de Séries">
    <a href="{{route('series.create')}} " class="btn btn-success mb-5">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success" role="alert">
        {{$mensagemSucesso}}
    </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-center">
            {{$serie->nome}}
            <span class="d-flex">
                <a class="btn btn-primary btn-sm" href="{{route('series.edit', $serie->id)}}">
                    E
                </a>

                <form action="{{route('series.destroy', $serie->id)}}" method="post" class="ms-3">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>