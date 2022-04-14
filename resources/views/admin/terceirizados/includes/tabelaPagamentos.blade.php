<table class="table table-bordered tabela-pagamentos" id="tabela-pagamentos-terceirizados">
    <thead>
    <tr>
        <th style="width: 5%">#</th>
        <th style="width:40%">Valor</th>
        <th style="width:20%">Data</th>
        <th style="width: 10%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($saidas as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->valor}}</td>
            <td>{{date('d/m/Y H:i', strtotime($p->data))}}</td>
            <td><a class="btn btn-warning btn-sm" href="{{route('terceirizado.editar.pagamento',['id'=>$contrato_id,'historico_id'=>$historico_id,'terceirizado_id'=>$terceirizado->id,'saida_id'=>$p->id])}}"><i class="fa fa-edit"></i></a></td>
        </tr>


    @endforeach
    </tbody>
</table>
