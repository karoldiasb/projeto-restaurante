@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Edição de Cardápio</h5>
    <form action="{{ route('cardapios.update', $cardapio->id) }}" method="post">
        @method('PUT')
        {{ csrf_field() }} 
        <div class="form-group">
            <br/>
            @error('msg')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}                     
                </div>
            @enderror
            <label for="restaurante">Restaurante:</label>
            <select class="form-select" name="restaurante_id" id="restaurante_id">
                @foreach($data as $r)
                    <option value="{{$r->id}}">{{$r->nome}}</option>
                @endforeach
            </select>
            <br/>
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{$cardapio->descricao}}"/>
            @error('descricao')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
            <br/>
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-select" value="{{$cardapio->ativo}}">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            @error('ativo')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
            
        </div>

        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
@endsection