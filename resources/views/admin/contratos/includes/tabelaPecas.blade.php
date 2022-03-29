



<table class="table table-bordered " id="tabela-historico-pecas">
    <thead>
    <tr>
        <th style="width: 50%">Peça</th>
        <th style="width: 10%">Valor</th>
        <th style="width: 10%">Qnt</th>
        <th style="width: 10%">Total</th>
        <th style="width: 10%">Autorizado</th>
        <th style="width: 10%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->pecas as $s)
        <tr>
            <td>{{$s->descricao}}</td>
            <td>{{$s->valor}}</td>
            <td>{{$s->qnt}}</td>
            <td>{{$s->qnt*$s->valor}}</td>
            <td>{{($s->autorizado?"Sim":"Não")}}
            </td>
            <td><a href="" class="excluir_peca" trabalho="{{$s->id}}" historico="{{$historico->id}}">e</a></td>
        </tr>
    @endforeach

    </tbody>
</table>

<script type="text/javascript">
    $(".excluir_trabalho").click(function () {

        var trabalho    =   $(this).attr('trabalho');
        var historico   =   $(this).attr('historico');

        $.ajax({
            type: "get",
            url: '{{route('historico.excluir.servico')}}',
            data: {'trabalho':trabalho,'historico':historico},
            success: function( data )
            {
                if('erro' in data){
                    alert(data.erro);
                }else{
                    $('#tabela-historico-servicos').html(data.html);
                }
            }
        });
        return false;
    });
</script>
