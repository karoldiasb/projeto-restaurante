<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
        @if(session()->has('token') and !empty(session('token')))
            <a class="navbar-brand" href="/logout">Sair</a>
        @else
            <a class="navbar-brand" href="/login">Entrar</a>
            <a class="navbar-brand" href="/registrar">Registrar</a>
        @endif
    </nav>
    <div class="container" style="margin-top: 3rem">
        <div class="row">
            @yield('conteudo') 
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>