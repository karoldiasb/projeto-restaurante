@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Cadastro de Produto</h5>
    <form action="{{ route('produtos.store') }}" method="post">
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
                    <option value="{{$r['id']}}">{{$r['descricao']}} - {{$r['restaurante']['nome']}}</option>
                @endforeach
            </select>
            <br/>
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao"/>
            @error('descricao')
                <strong style="color:red"> {{ $message }} </strong>
            @enderror
            <br/>
        </div>

        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
@endsection