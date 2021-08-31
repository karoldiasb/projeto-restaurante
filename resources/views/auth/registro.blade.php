@extends('layout.base')

@section('conteudo')
    <h5> Registro de usuário</h5>
    <form action="{{ route('registrar') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="nome" class="form-control" name="nome" id="nome"/>
            @if(!empty($error_validator['nome']))
                @foreach($error_validator['nome'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email"/>
            @if(!empty($error_validator['email']))
                @foreach($error_validator['email'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
            <label for="password">Senha:</label>
            <input type="password" class="form-control" name="password" id="password"/>
            @if(!empty($error_validator['password']))
                @foreach($error_validator['password'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
        </div>
        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>

    </form>
@endsection