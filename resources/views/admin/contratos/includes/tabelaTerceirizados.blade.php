


<table class="table table-bordered " id="tabela-historico-terceirizado">
    <thead>
    <tr>
        <th style="width: 30%">Fornecedor</th>
        <th style="width: 10%">Código</th>
        <th style="width: 20%">Data</th>
        <th style="width: 10%">Valor</th>
        <th style="width: 10%">Pagamento</th>

        <th style="width: 7%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->terceirizados as $t)
        <tr>
            <td>{{$t->fornecedor->nome}}</td>
            <td>{{$t->código}}</td>
            <td>{{date('d/m/Y H:m', strtotime($t->data))}}</td>
            <td>R$ {{$t->valor}}</td>
            <td>
                @if($t->pagamentos()->sum('valor') == $t->valor)
                    <span class="badge" style="background: #148f14 ; color: white" >PAGO</span>
                @elseif($t->pagamentos()->sum('valor') > $t->valor)
                    <span class="badge" style="background: #3878ab ; color: white" >SUPER</span>
                @else
                    <span class="badge" style="background: #bb291a ; color: white" >PENDENTE</span>
                @endif
            </td>
            <td><a class="btn btn-warning btn-sm" href="{{route('terceirizado.editar',['id'=>$contrato->id,'historico_id'=>$historico->id,'terceirizado_id'=>$t->id])}}"><i class="fa fa-edit"></i></a></td>
        </tr>
    @endforeach

    </tbody>
</table>
