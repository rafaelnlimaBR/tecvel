


<table class="table table-bordered " id="tabela-historico-pedidos">
    <thead>
    <tr>
        <th style="width: 30%">Fornecedor</th>
        <th style="width: 10%">Código</th>
        <th style="width: 20%">Data</th>
        <th style="width: 10%">Valor</th>
        <th style="width: 10%">V.D.</th>
        <th style="width: 7%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->Pedidos as $s)
        <tr>
            <td>{{$s->fornecedor->nome}}</td>
            <td>{{$s->numero_pedido}}</td>
            <td>{{date('d/m/Y H:m', strtotime($s->data))}}</td>
            <td>R$ {{$s->pecas->sum('valor_fornecedor')}}</td>
            <td>R$ {{$s->pecas->sum('valor_fornecedor')*(100-$s->desconto)/100}}</td>
            <td><a class="btn btn-warning btn-sm" href="{{route('pedido.editar',['id'=>$contrato->id,'historico_id'=>$historico->id,'pedido_id'=>$s->id])}}"><i class="fa fa-edit"></i></a></td>
        </tr>
    @endforeach

    </tbody>
</table>
