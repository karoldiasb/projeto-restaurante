@extends('layout.base')

@section('conteudo')
    @error('msg')
        <div class="alert alert-danger" role="alert">
            {{ $message }}                     
        </div>
    @enderror
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
        <button 
            type="button" 
            onclick="window.location='{{ route("cardapios.create") }}'" 
            class="btn btn-primary button"
        >
            Adicionar Cardápio
        </button>
        <button 
            type="button" 
            onclick="window.location='{{ route("produtos.create") }}'" 
            class="btn btn-primary button"
        >
            Adicionar Produtos
        </button>
    </div>
    @endif
    <br/><br/>
    <ul class="list-group">
        @foreach($restaurantes as $r)
            <li 
                class="list-group-item" 
                onclick="update({{json_encode($r)}})"
                style="cursor:pointer"
            >
                {{$r->nome}} 
                @if(session()->has('token') and !empty(session('token')))
                    <div style="display: -webkit-inline-box; float: right; gap: 0.5rem">
                        <button
                            type="button" 
                            onclick="window.location='{{ route("restaurantes.edit", ["restaurante" => $r->id]) }}'" 
                            class="btn btn-secondary btn-sm"
                        >
                            Editar Restaurante
                        </button>
                        <form action='{{ route("restaurantes.destroy", ["restaurante" => $r->id]) }}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar Restaurante</button>
                        </form>
                    </div>
                @endif
            </li>
        @endforeach 
        <br/>
    </ul>

    <div id="selecionado" style="display:none; margin-top: 2rem"></div>
            
@endsection

<script>
    function update(restaurante) {
        $('#selecionado').empty();
        $("#selecionado").append(`<h2>Restaurante ${restaurante.nome}</h2>`);
        
        let cardapios = '';
        let html_cardapio = '';
        const session = "<?php echo session('token')?>";

        if(restaurante.cardapios.length > 0){
            restaurante.cardapios.forEach(function(c){
                let url_edit = '{{ route("cardapios.edit", ["cardapio" => ":cardapio_id"]) }}';
                url_edit = url_edit.replace(':cardapio_id', c.id);
                let url_destroy = '{{ route("cardapios.destroy", ["cardapio" => ":cardapio_id"]) }}';
                url_destroy = url_destroy.replace(':cardapio_id', c.id);

                let ativo = 'Ativo';
                if(c.ativo != 1){
                    ativo = 'Inativo'
                }
                html_cardapio = `<h4> - ${c.descricao} (${ativo})</h4>`;
                if(session.length > 0){
                    html_cardapio += `
                    <div style="display: -webkit-inline-box; float: right; gap: 0.5rem; bottom: 2rem; position: relative;">
                        <button
                            type="button" 
                            onclick="window.location='${url_edit}'" 
                            class="btn btn-secondary btn-sm"
                        >
                            Editar Cardápio
                        </button>
                        <form action='${url_destroy}' method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar Cardápio</button>
                        </form>
                    </div>
                    <br/>
                `;
                }
                
                cardapios+=html_cardapio;
                if(c.produtos.length > 0){
                    cardapios+='<ul class="list-group" style="width: 100%">';
                    c.produtos.forEach(function(p){
                        let url_edit = '{{ route("produtos.edit", ["produto" => ":produto_id"]) }}';
                        url_edit = url_edit.replace(':produto_id', p.id);
                        let url_destroy = '{{ route("produtos.destroy", ["produto" => ":produto_id"]) }}';
                        url_destroy = url_destroy.replace(':produto_id', p.id);

                        cardapios += `<li class="list-group-item">${p.descricao}`;
                        if(session.length > 0){
                            cardapios += `
                                <div style="display: -webkit-inline-box; float: right; gap: 0.5rem;">
                                    <button
                                        type="button" 
                                        onclick="window.location='${url_edit}'" 
                                        class="btn btn-secondary btn-sm"
                                    >
                                        Editar Produto
                                    </button>
                                    <form action='${url_destroy}' method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Deletar Produto</button>
                                    </form>
                                </div>
                                `;
                        }
                        cardapios += '</li>';
                    
                    });
                    cardapios += '</ul>';
                }else{
                    cardapios+='<div class="alert alert-warning" role="alert">Não há produtos cadastrados!</div>';
                }
            });  
        }
        else{
            cardapios+='<div class="alert alert-warning" role="alert">Não há cardápios cadastrados!</div>';
        }
        
        $("#selecionado").append(cardapios);
        $("#selecionado").show();
    }
</script>