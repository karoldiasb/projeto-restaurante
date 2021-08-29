@extends('layout.base')

@section('conteudo')
    <h1>Restaurantes Disponíveis</h1>
    @if(session()->has('token') and !empty(session('token')))
    <div style="text-align: right;">
        <button 
            type="button" 
            onclick="window.location='{{ route("restaurantes.create") }}'" 
            class="btn btn-primary button"
        >
            Adicionar Restaurante
        </button>
    </div>
        
    @endif
    <ul class="list-group">
        @foreach($restaurantes as $r)
            <li 
                class="list-group-item" 
                onclick="update({{json_encode($r)}})"
                style="cursor:pointer"
            >
                {{$r['nome']}}
            </li>
        @endforeach 
    </ul>

    <div id="selecionado" style="display:none; margin-top: 2rem"></div>
            
@endsection

<script>
    function update(restaurante) {
        $('#selecionado').empty();
        $("#selecionado").append("<h2>Restaurante "+restaurante.nome+"</h2>");

        let cardapios = '';
        restaurante.cardapios.forEach(function(c){
            cardapios+='<h4> - '+c.descricao+'</h4>';
            if(c.produtos.length > 0){
                cardapios+='<ul class="list-group">';
                c.produtos.forEach(function(p){
                    cardapios += '<li class="list-group-item">'+p.descricao+'</li>';
                });
                cardapios += '</ul>';
            }else{
                cardapios+='<div class="alert alert-warning" role="alert">Não há produtos cadastrados!</div>';
            }
        });
        $("#selecionado").append(cardapios);
        $("#selecionado").show();
    }
</script>