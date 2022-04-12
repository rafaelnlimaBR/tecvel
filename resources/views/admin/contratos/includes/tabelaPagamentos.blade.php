



<table class="table table-bordered " id="tabela-historico-pagamentos">
    <thead>
    <tr>
        <th style="width: 20%">Pago</th>
        <th style="width: 20%">Recebido</th>
        <th style="width: 30%">Forma de Pagamento</th>
        <th style="width: 30%">Data</th>
        <th style="width: 5%">Editar</th>

    </tr>
    </thead>
    <tbody>

    @foreach($historico->pagamentos as $s)
        <tr>
            <td>{{$s->valor}}</td>
            <td>{{$s->valor_total}}</td>
            <td>{{$s->taxa->formaPagamento->nome." / ".$s->taxa->nome}}</td>
            <td>{{date('d/m/Y H:i',strtotime($s->data))}}</td>
            <td><a class="btn btn-warning btn-sm" href="{{route('historico.faturar.editar',['historico_id'=>$historico->id,'fatura_id'=>$s->id])}}"><i class="fa fa-edit"></i></a></td>
        </tr>
    @endforeach

    </tbody>
</table>
