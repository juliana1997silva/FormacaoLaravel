<x-layout title="Cadastro de  Série">

    <form action="/series/salvar" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da série</label>
            <input type="text" name="nome" id="nome" class="form-control">
        </div>
        <button type="submit" class="btn btn-info">Adicionar</button>
    </form>

</x-layout>