



<table class="table table-bordered " id="tabela-historico-pecas">
    <thead>
    <tr>
        <th style="width: 30%">Peça</th>
        <th style="width: 10%">Valor</th>
        <th style="width: 10%">V. Forn.</th>
        <th style="width: 8%">Qnt</th>
        <th style="width: 10%">Total</th>
        <th style="width: 10%">Autorizado</th>
        <th style="width: 5%">Editar</th>
        <th style="width: 5%">Excluir</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->pecas as $s)


            <tr>

                {{csrf_field()}}

                <td><input id="descricao-{{$s->id}}" name="descricao-{{$s->id}}" value="{{$s->descricao}}" class="form-control letra-pequena"></td>
                <td><input id="valor-{{$s->id}}" name="valor-{{$s->id}}" value="{{$s->valor}}" class="form-control letra-pequena dinheiro"></td>
                <td><input id="valor_fornecedor-{{$s->id}}" name="valor_fornecedor-{{$s->id}}" value="{{$s->pivot->valor_fornecedor}}" class="letra-pequena form-control"></td>
                <td><input  id="qnt-{{$s->id}}" name="qnt-{{$s->id}}" value="{{$s->pivot->qnt}}" class="letra-pequena form-control"></td>
                <td><input disabled name="total-{{$s->id}}" value="{{$s->pivot->qnt*$s->valor}}" class=" letra-pequena form-control"></td>

                <td>{{Form::select('autorizado', [0=>"Não",1=>"Sim"], $s->autorizado,['class'=>' letra-pequena form-control','id'=>'autorizado-'.$s->id])}}</td>
                <td><a class="btn-atualizar-peca btn btn-warning" contrato="{{$contrato->id}}"  peca="{{$s->id}}" historico="{{$historico->id}}" >{{$s->id}}</a></td>
                <td><a href="" class="excluir_peca btn btn-danger" contrato="{{$contrato->id}}"  peca="{{$s->id}}" historico="{{$historico->id}}">e</a></td>

            </tr>

    @endforeach
    </tbody>
</table>

<script type="text/javascript">



    $(".excluir_peca").click(function () {
        if(confirm("Excluir?")){
        var peca    =   $(this).attr('peca');
        var historico   =   $(this).attr('historico');
        var contrato    =   $(this).attr('contrato') ;

        $.ajax({
            type: "get",
            url: '{{route('peca.excluir')}}',
            data: {'peca':peca,'historico':historico,'contrato':contrato},
            success: function( data )
            {
                if('erro' in data){
                    alert(data.erro);
                }else{

                    $('#tabela-historico-pecas').html(data.pecas);
                    $('#tabela-historico-pedidos').html(data.pedidos);
                }
            }
        });
        return false;
        }else{
            return false
        }
    });
    $('.btn-atualizar-peca').click(function () {

        var id          =   $(this).attr("peca")
        var historico_id =   $(this).attr("historico");
        var contrato_id =   $(this).attr("contrato");
        var descricao   =   $("#descricao-"+id.toString()).val();
        var autorizado  =   $("#autorizado-"+id.toString()).val();
        var valor       =   $("#valor-"+id.toString()).val();
        var qnt       =   $("#qnt-"+id.toString()).val();
        var valor_fornecedor  =   $("#valor_fornecedor-"+id.toString()).val();
        var rota          =   "{{route("peca.atualizar")}}";


        $.ajax({

            url: rota,
            header:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            data: {

                'peca_id'               :   id,
                'historico_id'          :   historico_id,
                'descricao'             :   descricao,
                'autorizado'            :   autorizado,
                'valor'                 :   valor,
                'valor_fornecedor'      :   valor_fornecedor,
                'qnt'                   :   qnt,
                'contrato_id'           :   contrato_id
            },
            type: "post",
            success: function( data )
            {

                if('erro' in data){
                     alert(data.erro);
                 }else{

                     $('#tabela-historico-pecas').html(data.pecas);
                     $('#tabela-historico-pedidos').html(data.pedidos);
                 }
            },
            error:function (data) {

            }
        });
    });

</script>
