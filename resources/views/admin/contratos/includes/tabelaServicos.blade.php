



<table class="table table-bordered " id="tabela-historico-servicos">
    <thead>
    <tr>
        <th style="width: 50%">Serviço</th>
        <th style="width: 20%">Valor</th>
        <th style="width: 10%">Autorizado</th>
        <th style="width: 6%">Editar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->servicos as $s)
        <tr>
            <td>{{$s->descricao}}</td>
            <td>{{$s->pivot->valor}}</td>

            <td>{{($s->pivot->autorizado?"Sim":"Não")}}
            </td>
            <td><a href="" class="excluir_trabalho btn btn-warning btn-sm" trabalho="{{$s->pivot->id}}" historico="{{$historico->id}}"><i class="fa fa-edit"></i></a></td>
        </tr>
    @endforeach

    </tbody>
</table>

<script type="text/javascript">
    $(".excluir_trabalho").click(function () {

        if (confirm('Desejar excluir esse registro?')){
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
        }
        return false;
    });
</script>
