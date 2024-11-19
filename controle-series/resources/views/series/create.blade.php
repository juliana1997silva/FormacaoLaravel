<x-layout title="Cadastro de  Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="mb-3 col-8">
                <label for="nome" class="form-label">Nome da série</label>
                <input autofocus type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}">
            </div>
             <div class="mb-3 col-2">
                <label for="seasonQtd" class="form-label">Nº Temporadas:</label>
                <input type="text" name="seasonQtd" id="seasonQtd" class="form-control" value="{{ old('nome') }}">
            </div>
             <div class="mb-3 col-2">
                <label for="episodeQtd" class="form-label">Nº Episódio:</label>
                <input type="text" name="episodeQtd" id="episodeQtd" class="form-control" value="{{ old('nome') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-info">Adicionar</button>
    </form>
</x-layout>
