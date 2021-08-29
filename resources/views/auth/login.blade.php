@extends('layout.base')

@section('conteudo')
    <h5> Faça o login</h5>
    <form action="{{ route('logar') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email"/>
            <label for="password">Senha:</label>
            <input type="password" class="form-control" name="password" id="password"/>
        </div>
        @isset($error)
            <strong style="color:red"> {{ $error }} </strong>
        @endisset
        <br>
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
@endsection