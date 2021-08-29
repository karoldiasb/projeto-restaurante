@extends('layout.base')

@section('conteudo')
    <h5> Formulário de Cadastro de Restaurante</h5>
    <form action="{{ route('restaurantes.store') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome"/>
            @if($errors->has('nome'))
                @foreach($errors->get('nome') as $erro)
                    <strong class="erro"> {{ $erro }} </strong>
                @endforeach
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </form>
@endsection