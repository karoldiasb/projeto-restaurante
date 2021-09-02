@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Edição de Produto</h5>
    <form action="{{ route('produtos.update', $produto['id']) }}" method="post">
        @method('PUT')
        {{ csrf_field() }} 
        <div class="form-group">
            <br/>
            @error('msg')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}                     
                </div>
            @enderror
            <label for="restaurante">Cardápio:</label>
            <select class="form-select" name="cardapio_id" id="cardapio_id">
                @foreach($data as $r)
                    <option value="{{$r['id']}}">{{$r['descricao']}}</option>
                @endforeach
            </select>
            <br/>
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{$produto['descricao']}}"/>
            @error('descricao')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
            <br/>
        </div>

        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
@endsection