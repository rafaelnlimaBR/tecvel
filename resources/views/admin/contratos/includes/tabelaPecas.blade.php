



<table class="table table-bordered " id="tabela-historico-pecas">
    <thead>
    <tr>
        <th style="width: 40%">Peça</th>
        <th style="width: 10%">Valor</th>
        <th style="width: 10%">V. Forn.</th>
        <th style="width: 10%">Qnt</th>
        <th style="width: 10%">Total</th>
        <th style="width: 10%">Autorizado</th>
        <th style="width: 5%">Editar</th>
        <th style="width: 5%">Excluir</th>
    </tr>
    </thead>
    <tbody>

    @foreach($historico->pecas as $s)
        <form action="{{route('peca.atualizar')}}" method="POST" name="form-atualizar-peca-{{$s->id}}" class="form-atualizar-peca">
            {{csrf_field()}}
            <tr>

                <input type="hidden" name="id" value="{{$s->id}}" class="form-control">
                <input type="hidden" name="historico" value="{{$historico->id}}" class="form-control">
                <td><input name="descricao" value="{{$s->descricao}}" class="form-control"></td>
                <td><input name="valor" value="{{$s->valor}}" class="form-control"></td>
                <td><input name="valor_fornecedor" value="{{$s->valor_fornecedor}}" class="form-control"></td>
                <td><input name="qnt" value="{{$s->qnt}}" class="form-control"></td>
                <td><input name="qnt" value="{{$s->qnt*$s->valor}}" class="form-control"></td>

                <td>{{Form::select('autorizado', [0=>"Não",1=>"Sim"], $s->autorizado,['class'=>'form-control'])}}</td>
                <td><input type="submit" class="atualizar_peca btn btn-warning" peca="{{$s->id}}" historico="{{$historico->id}}" value="e"></td>
                <td><a href="" class="excluir_peca btn btn-danger" peca="{{$s->id}}" historico="{{$historico->id}}">e</a></td>
            </tr>
        </form>
    @endforeach

    </tbody>
</table>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("form[class='form-atualizar-peca']").submit(function () {


        var dados   = $(this).serialize();
        console.info(dados);
        var rota    =   this.action;

        alert(rota);
        $.ajax({
            type: "POST",
            url: rota,
            data: {dados},
            dataType: 'JSON',
            contentType: 'application/json',
            success: function( data )
            {
                if('erro' in data){
                    alert(data.erro);
                }else{
                    $('#tabela-historico-pecas').html(data.html);
                }
            },
            error:function (data) {
                alert(data.responseJSON);
                console.info(data);
            }
        });
        return false;
    });
    $(".excluir_peca").click(function () {

        var peca    =   $(this).attr('peca');
        var historico   =   $(this).attr('historico');

        $.ajax({
            type: "get",
            url: '{{route('peca.excluir')}}',
            data: {'peca':peca,'historico':historico},
            success: function( data )
            {
                if('erro' in data){
                    alert(data.erro);
                }else{
                    $('#tabela-historico-pecas').html(data.html);
                }
            }
        });
        return false;
    });


</script>
