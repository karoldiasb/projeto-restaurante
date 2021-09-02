@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Edição de Restaurante</h5>
    <form action="{{ route('restaurantes.update', $restaurante['id']) }}" method="post">
        @method('PUT')
        {{ csrf_field() }} 
        <div class="form-group">
            <br/>
            @error('msg')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}                     
                </div>
            @enderror
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{$restaurante['nome']}}"/>
            @error('nome')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
        </div>
        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
@endsection