<table class="table table-bordered tabela-pecas" id="tabela-pecas-pedido">
    <thead>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width:40%">Descrição</th>
        <th style="width:20%">V.F.</th>
        <th style="width: 10%">QNT</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pecas as $p)
        <tr>
            <td><input {{$p->pivot->pedido_id == null?"":($p->pivot->pedido_id == $pedido->id?"":"disabled") }}  class="checkbox-pecas" type="checkbox" historico_peca="{{$p->pivot->id}}"  pedido_id="{{$pedido->id}}"  {{$p->pivot->pedido_id == $pedido->id?'checked':""}}></td>
            <td>{{$p->descricao}}</td>
            <td>{{$p->pivot->valor_fornecedor}}</td>
            <td>{{$p->pivot->qnt}}</td>
        </tr>


    @endforeach
    </tbody>
</table>
<script type="text/javascript">


    $('.checkbox-pecas').change(function () {
        var pedido_id   =   $(this).attr('pedido_id');
        var historico_peca   =   $(this).attr('historico_peca');

        var selecionado = $(this).is(':checked');

        var rota    =   "{{route('pedido.adicionar.peca')}}"

        $.ajax({
            type: "get",
            url: rota,
            data:{'pedido_id':pedido_id,'selecionado':selecionado,'historico_peca':historico_peca} ,
            success: function( data )
            {


            },
            error:function (data,e) {
                console.info(data);
                alert(data);
            }
        });
        return false;

    });
</script>
