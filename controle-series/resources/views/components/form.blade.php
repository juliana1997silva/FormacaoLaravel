<form action="{{$action}}" method="post">
    @csrf
    @isset($nome)
        @method('PUT')
    @endisset
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da série</label>
        <input 
        type="text" 
        name="nome" 
        id="nome" 
        class="form-control"
        @isset($nome) value="{{$nome}}" @endisset
        >
    </div>
    <button type="submit" class="btn btn-info">{{$nomeButton}}</button>
</form>