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
            <td><input class="checkbox-pecas" type="checkbox" peca_id="{{$p->id}}" pedido_id="{{$pedido->id}}" historico_id="{{$historico_id}}" {{$p->pedido_id == $pedido->id?'checked':""}}></td>
            <td>{{$p->descricao}}</td>
            <td>{{$p->valor_fornecedor}}</td>
            <td>{{$p->qnt}}</td>
        </tr>


    @endforeach
    </tbody>
</table>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.checkbox-pecas').change(function () {
        var peca_id     =   $(this).attr('peca_id');
        var pedido_id   =   $(this).attr('pedido_id');
        var historico_id=   $(this).attr('historico_id');

        var selecionado = $(this).is(':checked');

        var rota    =   "{{route('pedido.adicionar.peca')}}"

        $.ajax({
            type: "get",
            url: rota,
            data:{'peca_id':peca_id,'pedido_id':pedido_id,'historico_id':historico_id,'selecionado':selecionado} ,
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