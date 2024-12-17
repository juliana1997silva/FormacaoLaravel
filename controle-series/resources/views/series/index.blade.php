<x-layout title="Controle de Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
        <a href="{{route('series.create')}} " class="btn btn-success mb-5">Adicionar</a>
    @endauth
    

    
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-center">
            @auth
                <a href="{{route('seasons.index', $serie->id)}}">
            @endauth
                {{$serie->nome}}
            @auth
                </a>
            @endauth
            
            @auth
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
            @endauth
        </li>
        @endforeach
    </ul>
</x-layout>