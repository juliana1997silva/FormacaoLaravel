<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a type="submit">Sair</a>
                </form>

            </div>
        </nav>
    @endauth


    <div class="container">
        <h1>{{ $title }}</h1>
        @isset($mensagemSucesso)
            <div class="alert alert-success" role="alert">
                {{ $mensagemSucesso }}
            </div>
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot }}
    </div>

</body>

</html>
