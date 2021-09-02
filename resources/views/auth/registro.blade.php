@extends('layout.base')

@section('conteudo')
    <h5> Registro de usuário</h5>
    <form action="{{ route('registrar') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group">
            <br/>
            @error('msg')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}                     
                </div>
            @enderror
            <label for="nome">Nome:</label>
            <input type="nome" class="form-control" name="nome" id="nome"/>
            @error('nome')
                <strong style="color:red"> {{ $message }} </strong>
                <br/>
            @enderror
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email"/>
            @error('email')
                <strong style="color:red"> {{ $message }} </strong>
                <br/>
            @enderror
            <label for="password">Senha:</label>
            <input type="password" class="form-control" name="password" id="password"/>
            @error('password')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
        </div>
        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>

    </form>
@endsection