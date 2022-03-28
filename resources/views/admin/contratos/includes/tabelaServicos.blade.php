




<table class="table table-bordered " id="tabela-historico-servicos">
    <thead>
    <tr>
        <th style="width: 50%">Serviço</th>
        <th style="width: 20%">Valor</th>
        <th style="width: 10%">Autorizado</th>
        <th style="width: 10%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->servicos as $s)
        <tr>
            <td>{{$s->descricao}}</td>
            <td>{{$s->pivot->valor}}</td>

            <td>{{($s->pivot->autorizado?"Sim":"Não")}}
            </td>
            <td><span class="badge bg-danger">55%</span></td>
        </tr>
    @endforeach

    </tbody>
</table>
