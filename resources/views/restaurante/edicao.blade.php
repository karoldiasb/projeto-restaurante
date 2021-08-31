@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Edição de Restaurante</h5>
    <form action="{{ route('restaurantes.update', $restaurante['id']) }}" method="post">
        @method('PUT')
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{$restaurante['nome']}}"/>
            @if(!empty($error_validator['nome']))
                @foreach($error_validator['nome'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
        </div>
        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
@endsection