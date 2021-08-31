@extends('layout.base')

@section('conteudo')
    <a href="/restaurantes"> Voltar</a>
    <br/><br/>
    <h5> Formulário de Cadastro de Cardápio</h5>
    <form action="{{ route('cardapios.store') }}" method="post">
        {{ csrf_field() }} 
        <div class="form-group">
            <br/>
            <label for="restaurante">Restaurante:</label>
            <select class="form-select" name="restaurante_id" id="restaurante_id">
                @foreach($data as $r)
                    <option value="$r['id']" name="restaurante_id">{{$r['nome']}}</option>
                @endforeach
            </select>
            <br/>
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao"/>
            @if(!empty($error_validator['descricao']))
                @foreach($error_validator['descricao'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
            <br/>
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-select">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            @if(!empty($error_validator['ativo']))
                @foreach($error_validator['ativo'] as $erro)
                    <strong style="color:red"> {{ $erro }} </strong>
                @endforeach
            @endif
        </div>
        <br>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
@endsection