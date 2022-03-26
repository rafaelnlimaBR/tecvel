


    <form action="{{route('historico.cadastrar.servico')}}" method="post">



        <div class="row">
            <div class="col-sm-5">

                <div class="form-group">
                    <label>Serviços</label>
                    {{ Form::select('servico_id', [], null ,['class'=>'form-control selectServicos ','id'=>'selectServicos','required']) }}
                    {{csrf_field()}}
                    <input type="hidden" name="historico_id" value="{{$historico->id}}">
                    <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Valor</label>
                    <input class="form-control dinheiro" type="text" name="valor" id="valorServico" placeholder="Valor">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Adicionar</label>
                    <button class="form-control btn btn-primary" type="submit"  >Adicionar</button>
                </div>
            </div>
        </div>
    </form>

<table class="table table-bordered">
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
